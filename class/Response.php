<?php

class Response {
    public function json ($message, $data = [], $status = 200) {
        header('Content-type: application/json');
        http_response_code($status);
        echo json_encode([
            'message' => $message,
            'data' => $data
        ]);
        exit;
    }
}