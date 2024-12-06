<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{

    public function home()
    {
        $param = [
            'name' => 'Bá'
        ];
        $this->setLayout('auth');
        return $this->render('home', $param);
    }
}