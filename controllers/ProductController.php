<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\services\ProductService;

class ProductController extends Controller
{
    private $productService;
    private $request;

    public function __construct() {
        $this->productService = new ProductService();
        $this->request = new Request();
    }
    private function product($category) {
        $products = $this->productService->getProductsByCondition($category, 1, 6);
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
        $name = $this->request->getBody()['product-name'];
        $products = $this->productService->getProductByName($name);
        $data = ['products' => $products];
        return $this->render('search', $data);
    }

    public function filter() {
        $data = $this->request->getBody();
        $products = $this->productService->getFilteredProducts($data);
        $data = ['products' => $products];
        return $this->render('search', $data);
    }
}