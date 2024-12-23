<?php

namespace app\services;

use app\models\OrderItemModel;

class OrderItemService
{
    private $orderItemsModel;
    public function __construct()
    {
        $this->orderItemsModel = new OrderItemModel();
    }

    public function getOrderItemsByUserId ($userId) {
        $userId = (int) $userId;
        return $this->orderItemsModel->getOrderItemsByUserId($userId);
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

    public function createOrderItem($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId) {
        return $this->orderItemsModel->createNewOrderItem($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId);
    }

    public function addToCart($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId) {
        $existingOrderItem = $this->getExistingOrderItem($userId, $size, $productId,  $productColor);
        if ($existingOrderItem !== false) {
            $orderItemId = $existingOrderItem['id'];
            $newQuantity = $existingOrderItem['quantity'] + (int) $quantity;
            $addToCart = $this->updateOrderItemQuantity($orderItemId, $newQuantity);
        } else {
            $addToCart = $this->createOrderItem($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId);
        }
        return $addToCart;
    }

    public function getExistingOrderItem($userId, $size, $productId,  $productColor) {
        $userId = (int) $userId;
        $productId = (int) $productId;
        return $this->orderItemsModel->getExistingOrderItem($userId, $size, $productId,  $productColor);
    }
}