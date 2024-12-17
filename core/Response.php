<?php

namespace app\core;

class Response
{
    private $data;
    private $statusCode;
    private $headers = [];

    public function __construct($data = null, $statusCode = 200)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    public function setStatusCode($statusCode) {
        http_response_code($statusCode);
    }


    public function setBody($data)
    {
        $this->data = $data;
    }

    public function setContentType($contentType) {
        $this->headers['Content-Type'] = $contentType;
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function send()
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }
        echo ($this->data);
    }

    public function sendJson($data) {
        $this->data = $data;
        http_response_code($this->statusCode);
        $this->setContentType('application/json');
        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }
        echo (json_encode($this->data));
    }

}