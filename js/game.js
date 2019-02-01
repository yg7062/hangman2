// Selectors
var $gameForm = $("#gameForm"),
    $incorrectWordsList = $("#incorrect-words > ul"),
    $levelText = $(".level-details > h3 > span"),
    $chanceText = $(".level-details > h4 > span"),
    $blanksList = $(".blanks > ul"),
    $hintSection = $(".hint"),
    $hintText = $(".hint > h4 > span"),
    $actions = $(".actions > ul > li > button"),
    $hangManCanvas = $(".hangman-section > canvas")[0],
    $hintBtn = $("#hint-btn"),
    $gameOver = $(".game-over"),
    $gameOverText = $gameOver.find('.inner > h1'),
    $musicFile = $("#musicFile");

var audio = new Audio();
audio.addEventListener('ended', function () {
    this.play();
})

/**
 * Event Listeners
 */
$musicFile.on('change', function (e) {
    var file = $(this)[0].files[0]
    if (validateFile(file)) {
        var formData = new FormData();
        formData.append('music_file', file)
        $.ajax({
            url: 'api.php?action=uploadMusic',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                audio.src = response.data.music
                audio.play()
            }
        })
    }

})

// Initialize Hangman Canvas
if ($hangManCanvas) {
    var ctx = $hangManCanvas.getContext("2d");
    ctx.strokeStyle = "#FFF";
    ctx.lineWidth = 2;
}

// Start Game Form Submission
$gameForm.on('submit', function (e) {
    e.preventDefault();
    var data = {
        category_id: $(this).find('[name="category"]').val()
    }

    $.post('api.php?action=startGame', data, function (response) {
        window.location = 'play.php'
    })
})

// Alphabets Click Event
$actions.on('click', function (e) {
    $(this).addClass('active')
    var clickedWord = $(this).text().toUpperCase();
    game.checkWord(clickedWord)
})

/**
 * Functions
 */

function drawLine (moveToX, moveToY, lineX, lineY) {
    ctx.beginPath();
    ctx.moveTo(moveToX, moveToY);
    ctx.lineTo(lineX, lineY);
    ctx.stroke();
    ctx.closePath();
}

function drawArc (x, y, r, sA, eA) {
    ctx.beginPath();
    ctx.arc(x, y, r, sA, eA);
    ctx.stroke();
    ctx.closePath();
}

function playMusic (src) {
    if (!src) {
        audio.src = '';
    } else {
        audio.src = src
    }
    audio.play();
}

function toggleMusic (e) {
    audio.paused ? audio.play() : audio.pause();
    $(e).find('span').toggleClass('glyphicon-volume-up').toggleClass('glyphicon-volume-off')
}

function validateFile (file) {
    if (file.type != 'audio/mp3') {
        alert('Invalid File Type Only Mp3 files are allowed');
        return false;
    }

    if ((file.size / 1024) > 1024) {
        alert('Maximum File size cannot be exceed more than 1 MB')
        return false;
    }
    return true;
}
function onClickUploadBtn (e) {
    $musicFile.click();
}

var bodyParts = [
    {
        type: 'rightLeg',
        draw: function () {
            drawLine(150, 200, 200, 240)
        }
    }, {
        type: 'leftLeg',
        draw: function () {
            drawLine(150, 200, 100, 240)
        }
    }, {
        type: 'rightArm',
        draw: function () {
            drawLine(150, 130, 210, 140)
        }
    }, {
        type: 'leftArm',
        draw: function () {
            drawLine(90, 140, 150, 130)
        }
    }, {
        type: 'chest',
        draw: function () {
            drawLine(150, 110, 150, 200)
        }
    }, {
        type: 'head',
        draw: function () {
            drawArc(150, 80, 30, 0, 2 * Math.PI)
        }
    }, {
        type: 'hanger2',
        draw: function () {
            drawLine(150, 20, 150, 50)
        }
    }, {
        type: 'hanger1',
        draw: function () {
            drawLine(1, 20, 150, 20)
        }
    }, {
        type: 'stand',
        draw: function () {
            drawLine(1, 20, 1, 350)
        }
    }, {
        type: 'base',
        draw: function () {
            drawLine(1, 349, 260, 349)
        }
    }
]

var game = {
    level: 1,
    chances: 10,
    spaces: 0,
    word: null,
    correct: 0,
    wordId: null,
    getUser: function () {
        $.get('api.php?action=getUser', function (response) {
            var music = response.data.music ? response.data.music : ''
            playMusic(music)
            game.play()
        })
    },
    play: function () {
        $.get('api.php?action=play', function (response) {
            game.reset();
            var data = response.data
            game.setLevel(data.level)
            game.getWord();
        })
    },
    reset: function () {
        game.chances = 10;
        game.wordId = null
        game.spaces = 0
        game.correct = 0
        $gameOver.css('display', "none");
        ctx.clearRect(0, 0, $hangManCanvas.width, $hangManCanvas.height);
        $incorrectWordsList.empty();
        $actions.each(function (item) {
            $(this).removeClass('active');
        })
    },
    getWord: function () {
        $.get('api.php?action=word', function (response) {
            $hintSection.addClass('invisible');
            game.word = response.data.answer.toUpperCase();
            game.wordId = response.data.id
            game.setWord();
            game.setChance(10);
            game.setHint(response.data.hint)
        })
    },
    setLevel: function (level) {
        game.level = level
        $levelText.text(level)
    },
    setChance: function (chances) {
        game.chances = chances
        $chanceText.text(chances)
    },
    setWord: function () {
        var length = game.word.length
        var html = ''
        for (var i = 0; i < length; i++) {
            var text = '_';
            if (game.word[i] == ' ') {
                game.spaces++
                text = ' '
            }
            html += `<li>${text}</li>`
        }
        $blanksList.html(html)
    },
    setHint: function (hint) {
        $hintText.text(hint)
    },
    toggleHint: function () {
        $hintSection.toggleClass('invisible')
    },
    updateLevel: function () {
        $.post('api.php?action=updateLevel', {
            word_bank_id: game.wordId
        }, function (response) {
            if (response.data.status) {
                $gameOver.css("display", "block")
                $gameOverText.text(response.message)
            } else {
                game.play();
            }
        })
    },
    over: function () {
        $.get('api.php?action=gameOver', function (response) {
            $gameOver.css('display', 'block');
            $gameOverText.text(response.message)
        })
    },
    checkWord: function (letter) {
        var wordLength = game.word.length
        for (var i = 0; i < wordLength; i++) {
            if (letter == game.word[i]) {   // If Letter Matches
                $blanksList.find(`li:nth-child(${i + 1})`).text(letter)
                game.correct++
            }
        }
        var index = game.word.indexOf(letter)
        if (index === -1) {
            $incorrectWordsList.append(`<li>${letter}</li>`)
            game.setChance(game.chances - 1)
            bodyParts[game.chances].draw()   // Draw Image
        }

        if ((game.correct + game.spaces) === wordLength) {
            game.updateLevel();
        }

        if (game.chances <= 0) {
            game.over();
        }
    },
    exit: function () {
        if (window.confirm("Quit Game ?")) {
            $.get('api.php?action=exit', function (response) {
                window.location = 'index.php'
            })
        }
    },
    changeStatus (status) {
        var msg = status == 0 ? 'Stop' : 'Resume';
        if (window.confirm(`${msg} Game ?`)) {
            $.post('api.php?action=changeStatus', { status: status }, function (response) {
                window.location.reload();
            })
        }
    }
}