<?php

namespace app\controllers;

use app\core\Controller;
use app\services\ProductService;

class SiteController extends Controller
{
    private $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }

    public function home() {
        $data = ['outStandingProducts' => $this->productService->getTop4OutStandingProducts()];
        return $this->render('home', $data);
    }

    public function dashboard() {
        $this->setLayout('admin');
        return $this->render('admin/dashboard');
    }

}