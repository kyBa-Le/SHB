<?php

namespace app\core;

class MiddleWare
{
    private static $instance;
    private $isLoggedIn = false;

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
}