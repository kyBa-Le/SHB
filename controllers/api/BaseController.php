<?php

namespace app\controllers\api;

use app\core\Application;

abstract class BaseController
{
    protected $request;
    protected $response;

    public function __construct()
    {
        $this->request = Application::$app->request;
        $this->response = Application::$app->response;
    }

    public function getRequest(): \app\core\Request
    {
        return $this->request;
    }

    public function setRequest(\app\core\Request $request): void
    {
        $this->request = $request;
    }

    public function getResponse(): \app\core\Response
    {
        return $this->response;
    }

    public function setResponse(\app\core\Response $response): void
    {
        $this->response = $response;
    }


}