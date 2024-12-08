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
}