<?php

class Middleware
{
    private $auth;
    public function __construct()
    {
        $this->auth = new Auth();
    }
    public function auth()
    {
        $user = $this->auth->user();
        if ($user && !$user['status']) {
            header('Location: index.php');
            exit;
        }
        if (!$this->auth->user()) {
            header('Location: index.php');
            exit;
        }
    }
    public function guest()
    {
        $user = $this->auth->user();
        if ($user && $user['status']) {
            header('Location: play.php');
        } else if ($user) {
            return $user;
        }
    }
}