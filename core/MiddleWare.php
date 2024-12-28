<?php

namespace app\core;

class MiddleWare
{
    private static $instance;
    private $needToCheck = ['/cart', '/payment', '/user'];

    private function __construct() {}

    private function __clone() {}

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function isLoggedIn()
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['login_time'])) {
            return false;
        }
        $currentTime = time();
        if ($currentTime - $_SESSION['login_time'] > 10 * 24 * 60 * 60) {
            session_destroy();
            return false;
        }
        return true;
    }

    public function isAdmin() {
        if (!isset($_SESSION['admin'])) {
            return false;
        }
        return true;
    }

    public function handleRequest() {
        $url = Application::$app->request->getPath();
        foreach ($this->needToCheck as $needCheck) {
            if (str_contains($url, $needCheck)) {
                if (!$this->isLoggedIn()) {
                    $this->redirect('/login');
                    exit;
                }
            }
        }
        if (str_contains($url, '/admin')) {
            if (!$this->isAdmin()) {
                $this->redirect('/');
            }
        }
    }

    private function redirect($url) {
        header("Location: $url");
    }
}