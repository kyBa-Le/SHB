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
}