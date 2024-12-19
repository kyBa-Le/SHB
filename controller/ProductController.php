<?php

namespace app\controller;

use app\model\ProductsModel;

class ProductController
{
    private $productModel;
    public function __construct()
    {
        $this->productModel = new ProductsModel();
    }

    public function getTop4OutStandingProducts() {
        $products = $this->productModel->getProductsSortedByPurchases();
        return array_slice($products, 0, 4);
    }

    public function getProductsByCondition($category, $pageNo, $pageSize)
    {
        return $this->productModel->getPaginatedProductsByCategory($category, $pageNo, $pageSize);
    }

    public function getProductByName($name) {
        return $this->productModel->getProductsByName($name);
    }

    public function getProductById($id){
        return $this->productModel->getProductById($id);
    }
}