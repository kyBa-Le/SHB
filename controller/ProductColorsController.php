<?php

namespace app\controller;

use app\model\ProductColorsModel;

class ProductColorsController
{
    private $productColorsModel;
    public function __construct() {
        $this->productColorsModel = new ProductColorsModel();
    }

    public function getProductColorsByProductId($productId) {
        return $this->productColorsModel->getProductColorsByProductId($productId);
    }
}