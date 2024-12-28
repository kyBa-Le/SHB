<?php

namespace app\validation;

use app\services\OrderItemService;
use app\services\ProductService;

class OrderItemValidation
{
    private $productService;

    public function __construct() {
        $this->productService = new ProductService();
    }
    public function validateOrderItemQuantity ($orderItem, $newQuantity) {
        $product = $this->productService->getProductById($orderItem['product_id']);
        if ($newQuantity > $product['quantity']) {
            return false;
        }
        return true;
    }
}