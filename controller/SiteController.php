<?php

namespace app\controller;

use app\core\Controller;

class SiteController extends Controller
{
    public function home() {
        $productController = new ProductController();
        $data = ['outStandingProducts' => $productController->getTop4OutStandingProducts()];
        return $this->render('home', $data);
    }
}