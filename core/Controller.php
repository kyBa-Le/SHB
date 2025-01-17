<?php

namespace app\core;

class Controller
{
    public $layout = 'main';
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
    public function setLayout($layout) {
        Application::$app->controller->layout = $layout;
    }
}