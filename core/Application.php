<?php
namespace app\core;

class Application
{
    public $router;
    public $request;
    public $response;
    public $controller;
    public static $database;
    public static $app;
    public function __construct($config) {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->controller = new Controller();
        self::$database = new Database($config['database']);
        self::$app = $this;
    }

    public function run() {
        MiddleWare::getInstance()->handleRequest();
        echo $this->router->resolve();
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller): void
    {
        $this->controller = $controller;
    }
}