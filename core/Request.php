<?php

namespace app\core;

class Request
{
    public function getPath() {
        $path = $_SERVER['REQUEST_URI'] ?? "/";
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }
    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function getBody() {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        if (strpos($contentType, 'application/json') !== false) {
            $rawBody = file_get_contents('php://input');
            error_log("Raw JSON Body: " . $rawBody);
            $body = json_decode($rawBody, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $body;
            } else {
                error_log("JSON decode error: " . json_last_error_msg());
                return null;
            }
        }
        if (strpos($contentType, 'application/x-www-form-urlencoded') !== false || 
            strpos($contentType, 'multipart/form-data') !== false) {
            $body = [];
            if ($this->getMethod() == 'get') {
                foreach ($_GET as $key => $value) {
                    $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
            if ($this->getMethod() == 'post') {
                foreach ($_POST as $key => $value) {
                    $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
            return $body;
        }
        return null;
    }
    
    public function isPost() {
        return $this->getMethod() == 'post';
    }
    public function isGet() {
        return $this->getMethod() == 'get';
    }
}