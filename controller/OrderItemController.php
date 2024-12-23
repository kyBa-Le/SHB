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

    public function updateOrderItemQuantity($id, $quantity)
    {
        $id = (int) $id;
        $quantity = (int) $quantity;
        $this->orderItemsModel->updateOrderItemQuantity($id, $quantity);
        return $this->orderItemsModel->getOrderItemById($id);
    }

    public function deleteOrderItem($id)
    {
        return $this->orderItemsModel->deleteOrderItemById($id);
    }

    public function getOrderItemById($id) 
    {
        return $this->orderItemsModel->getOrderItemById($id);
    }
    
    public function addToCart($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId) {
        $userId = (int) $userId;
        $quantity = (int) $quantity;
        $unitPrice = (int) $unitPrice;
        $productId = (int) $productId;
        return $this->orderItemsModel->addToCart($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId);
    }

    public function getExistingOrderItem($userId, $size, $productId,  $productColor) {
        $userId = (int) $userId;
        $productId = (int) $productId;
        return $this->orderItemsModel->getExistingOrderItem($userId, $size, $productId,  $productColor);
    }
}