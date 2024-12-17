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
        $body = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
            if (strpos($contentType, 'application/json') !== false) {
                $rawBody = file_get_contents('php://input');
                $body = json_decode($rawBody, true);
            } else if(strpos($contentType, 'application/x-www-form-urlencoded') !== false ||
                strpos($contentType, 'multipart/form-data') !== false) {
                foreach ($_POST as $key => $value) {
                    $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
        return $body;
    }
    public function isPost() {
        return $this->getMethod() == 'post';
    }
    public function isGet() {
        return $this->getMethod() == 'get';
    }
}