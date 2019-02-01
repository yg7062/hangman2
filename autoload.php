<?php
session_start();

spl_autoload_register(function ($class_name) {
    include 'class/'.$class_name . '.php';
});


$db = new Database();
$auth = new Auth();
$response = new Response();
$middleware = new Middleware();