<?php

namespace app\core;

class Response
{
    public function setStatusCode($statusCode) {
        http_response_code($statusCode);
    }

}