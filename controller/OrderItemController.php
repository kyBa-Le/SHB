<?php

namespace app\controller;
use app\model\OrderItemModel; 

class OrderItemController
{

    private $orderItemsModel;
    public function __construct()
    {
        $this->orderItemsModel = new OrderItemModel();
    }

    public function getOrderItemsByUserId ($userId) {
        $userId = (int) $userId;
        $orderItems = $this->orderItemsModel->getOrderItemsByUserId($userId);
        return $orderItems;
    }
    
    public function addToCart($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId) {
        $userId = (int) $userId;
        $quantity = (int) $quantity;
        $unitPrice = (int) $unitPrice;
        $productId = (int) $productId;
        return $this->orderItemsModel->addToCart($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId);
    }
}