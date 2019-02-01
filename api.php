<?php
require 'autoload.php';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'startGame') {
        startGame();
    } else if ($action == 'getUser') {
        $response->json('User Data', $auth->user());
    } else if ($action == 'play') {
        getGameHistory();
    } else if ($action == 'word') {
        getWord();
    } else if ($action == 'updateLevel') {
        updateLevel();
    } else if ($action == 'gameOver') {
        resetGameData();
        $response->json('You Loss the Game');
    } else if ($action == 'changeStatus') {
        $status = $_REQUEST['status'];
        $db->update('users', ['status' => $status], [
            ['id', '=', $auth->userId()]
        ]);
        $auth->setKey('status', $status);
        $response->json('You Loss the Game');

    } else if ($action == 'exit') {
        exitGame();
    } else if ($action == 'uploadMusic') {
        if ($_FILES['music_file']) {
            $file = $_FILES['music_file'];
            $size = $file['size'];
            if (($size / 1024) > 1024) {
                $response->json('Maximum 1 Mb File Allowed', []);
            }
            if (!in_array($file['type'], ['audio/mp3'])) {
                $response->json('Only Mp3 files are allowed', []);
            }

            $store_path = 'music/' . $file['name'];
            move_uploaded_file($file['tmp_name'], $store_path);

            $db->update('users', ['music' => $store_path], [
                ['id', '=', $auth->userId()]
            ]);
            $auth->setKey('music', $store_path);

            $response->json('Music File Updated Successfully', $auth->user());
        }
    }
}

function startGame()
{
    global $db, $response, $auth;
    $user = $db->insert('users', ['category_id' => $_POST['category_id']]);
    $auth->set($user);
    addLevel();
    return $response->json('User Added', $user);
}


function addLevel()
{
    global $db, $auth;
    $max_level = $db->max('game_history', 'level', [
        ['user_id', '=', $auth->userId()]
    ]);
    $db->insert('game_history', [
        'user_id' => $auth->userId(),
        'level' => $max_level + 1
    ]);
    return true;
}

function getGameHistory()
{
    global $db, $auth, $response;
    $user_id = $auth->userId();
    $data = $db->select("SELECT * FROM game_history WHERE user_id = $user_id  ORDER BY id DESC")->first();
    $response->json('Data', $data);
}

function getWord()
{
    global $db, $auth, $response;
    $cat_id = $auth->categoryId();
    $user_id = $auth->userId();
    $data = $db->select("SELECT WB.* FROM word_bank WB WHERE NOT EXISTS (
    SELECT * from game_history GD WHERE WB.id = GD.word_bank_id AND GD.user_id = $user_id)
    AND WB.category_id = $cat_id ORDER BY RAND() LIMIT 1")->first();
    $response->json('Data', $data);
}

function updateLevel()
{
    global $db, $auth, $response;
    $word_bank_id = $_POST['word_bank_id'];
    $max_level = $db->max('game_history', 'level', [
        ['user_id', '=', $auth->userId()]
    ]);
    if ($max_level >= 10) {
        resetGameData();
        $response->json('You Won', ['status' => 1]);
    }
    $db->update('game_history', ['word_bank_id' => $word_bank_id], [
        ['user_id', '=', $auth->userId()],
        ['level', '=', $max_level]
    ]);
    addLevel();
    $response->json('Level Updated', []);
}

function resetGameData()
{
    global $db, $auth, $response;
    // Delete Game Data (Except First Level In Case User Want to Restart Game)
    $db->delete('game_history', [
        ['user_id', '=', $auth->userId()],
        ['level', '!=', 1]
    ]);
    // Update First Question (SET Word Bank For First Level to Null)
    $db->update('game_history', ['word_bank_id' => null], [
        ['user_id', '=', $auth->userId()],
        ['level', '=', 1]
    ]);
}

function exitGame()
{
    global $auth, $db, $response;
    $db->delete('users', [
        ['id', '=', $auth->userId()]
    ]);
    session_destroy();
    $response->json('Game Data Deleted', []);
}

function updateFile()
{

}