<?php
require 'autoload.php';
$middleware->auth();
?>
<html lang="en">
<head>   
    <title>Hangman</title>
    <?php require 'includes/header.php' ?>
</head>
<body onload = "game.getUser()">
    <div class="full-bg">
        <input type="file" name="music_file" id="musicFile" class="hidden">
        <div class="controls">
            <button onclick="game.exit()" title="Exit Game"><span class="glyphicon glyphicon-off"></span></button>
            <button onclick="toggleMusic(this)" title="Mute"><span class="glyphicon glyphicon-volume-up"></span></button>
            <button onclick="onClickUploadBtn(this)" title="Upload Music File"><span class="glyphicon glyphicon-cloud-upload"></span></button>
            <button onclick="game.changeStatus(0)" title="Stop Game"><span class="glyphicon glyphicon-stop"></span></button>
            
        </div>
        <div class="container">
            <div class="game-wrapper">
            <div class="row">
                <div class="col-sm-3">
                    <div id="incorrect-words">
                    <h3>Incorrect Words</h3>
                    <ul class="list-inline">
                    </ul>
                    </div>
                    <br>
                    <!-- Hangman -->
                    <div class="hangman-section">
                        <canvas height="350px"></canvas>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="game">
                        <div class="level-details">
                            <h3>Level: <span>1</span></h3>
                            <h4>Chances: <span>10</span>/10</h4>
                        </div>
                        <div class="clearfix"></div>

                        <div class="blanks text-center">
                            <ul class="list-inline">
                            </ul>
                        </div>

                        <div class="hint invisible text-center">
                            <h4>Hint: <span></span></h4>
                        </div>

                        <div class="actions text-center">
                            <ul class="list-inline">
                                <li><button>A</button></li>
                                <li><button>B</button></li>
                                <li><button>C</button></li>
                                <li><button>D</button></li>
                                <li><button>E</button></li>
                                <li><button>F</button></li>
                                <li><button>G</button></li>
                                <li><button>H</button></li>
                                <li><button>I</button></li>
                                <li><button>J</button></li>
                                <li><button>K</button></li>
                                <li><button>L</button></li>
                                <li><button>M</button></li>
                                <li><button>N</button></li>
                                <li><button>O</button></li>
                                <li><button>P</button></li>
                                <li><button>Q</button></li>
                                <li><button>R</button></li>
                                <li><button>S</button></li>
                                <li><button>T</button></li>
                                <li><button>U</button></li>
                                <li><button>V</button></li>
                                <li><button>W</button></li>
                                <li><button>X</button></li>
                                <li><button>Y</button></li>
                                <li><button>Z</button></li>
                            </ul>
                            <br>
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-4">
                                <button onclick="game.toggleHint()" id="hint-btn" class="btn-block btn btn-success">Hint ?</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="game-over">
        <div class="inner">
            <h1>Game Over</h1>
            <button onclick="game.play()" class="btn btn-success btn-lg">Restart</button>
            <button onclick="game.exit()" class="btn btn-danger btn-lg">Exit</button>
        </div>
    </div>
    <?php require 'includes/footer.php' ?>
</body>
</html>