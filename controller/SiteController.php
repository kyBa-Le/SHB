<?php

namespace app\controller;

use app\core\Controller;

class SiteController extends Controller
{
    public function home() {
        $data = ['outStandingProducts' => [new ProductController, 'getTop4OutStandingProducts']];
        return $this->render('home', $data);
    }
}