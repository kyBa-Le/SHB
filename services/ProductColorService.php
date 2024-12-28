<?php

namespace app\services;

use app\models\ProductColorsModel;

class ProductColorService
{
    private $productColorsModel;
    public function __construct() {
        $this->productColorsModel = new ProductColorsModel();
    }

    public function getProductColorsByProductId($productId) {
        return $this->productColorsModel->getProductColorsByProductId($productId);
    }

}