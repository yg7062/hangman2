<?php
class Auth {
    public function user () {
        return $_SESSION['user'] ?? false;
    }

    public function set ($data) {
        $_SESSION['user'] = $data;
    }

    public function userId () {
        return $this->user()['id'];
    }

    public function categoryId () {
        return $this->user()['category_id'];
    }

    public function setKey($key, $value) {
        $_SESSION['user'][$key] = $value;
    }
}