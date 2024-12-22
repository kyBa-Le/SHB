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
}