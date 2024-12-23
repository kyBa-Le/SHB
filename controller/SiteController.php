<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    private $productController;
    private $userController;

    public function __construct() {
        $this->productController = new ProductController();
        $this->userController = new UserController();
    }

    public function home() {
        $data = ['outStandingProducts' => $this->productController->getTop4OutStandingProducts()];
        return $this->render('home', $data);
    }
  
    public function logout() {
        session_destroy();
        header('Location: /');
    }

    private function product($category) {
        $products = $this->productController->getProductsByCondition($category, 1, 6);
        $data = ['products' => $products, 'category' => $category];
        return $this->render('product', $data);
    }

    public function women() {
        return $this->product('Women');
    }

    public function men() {
        return $this->product('Men');
    }

    public function children() {
        return $this->product('Children');
    }

    public function search() {
        $name = Application::$app->request->getBody()['product-name'];
        $products = $this->productController->getProductByName($name);
        $data = ['products' => $products];
        return $this->render('searchProduct', $data);
    }

    public function getFilteredProducts() {
        $request = new Request();
        $data = $request->getBody();
        $products = $this->productController->getFilteredProducts($data);
        $data = ['products' => $products];
        return $this->render('searchProduct', $data);
    }
}