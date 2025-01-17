<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\services\ProductService;

class ProductController extends Controller
{
    private $productService;
    private $request;
    protected $productsModel;

    public function __construct() {
        $this->productService = new ProductService();
        $this->request = new Request();
    }
    private function products($category) {
        $products = $this->productService->getProductsByCondition($category, 1, 6);
        $data = ['products' => $products, 'category' => $category];
        return $this->render('product', $data);
    }

    public function women() {
        return $this->products('Women');
    }

    public function men() {
        return $this->products('Men');
    }

    public function children() {
        return $this->products('Children');
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

    public function admin() {
        $this->setLayout("admin");
        $data = $this->request->getBody();
        if (!isset($data['page']) && !isset($data['size'])) {
            $data['page'] = 1;
            $data['size'] = 10;
        }
        $products = $this->productService->getProductWithPagination($data['page'], $data['size']);
        $totalProducts = $this->productService->getTotalProducts();
        return $this->render('admin/products',  ['products' => $products, 'totalProducts' => $totalProducts['total'] ?? null]);
    }
}