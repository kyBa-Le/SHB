<?php

namespace app\controllers\api;

use app\services\OrderItemService;

class OrderItemController extends BaseController
{
    private $orderItemService;

    public function __construct() {
        parent::__construct();
        $this->orderItemService = new OrderItemService();
    }
    public function getOrderItemsByUserId() {
        $id = $_SESSION['user']['id'];
        $orderItems = $this->orderItemService->getOrderItemsByUserId($id);
        $this->response->sendJson($orderItems);
    }

    public function updateOrderItemQuantityById()
    {
        if ($_SESSION['user']) {
            $data = $this->request->getBody();
            $id = $data['id'];
            $quantity = $data['quantity'];
            $orderItem = $this->orderItemService->updateOrderItemQuantity($id, $quantity);
            $this->response->sendJson($orderItem);
        }
    }

    public function deleteOrderItemById()
    {
        if ($_SESSION['user']) {
            $id = $this->request->getBody()['id'];
            $this->orderItemService->deleteOrderItem($id);
            $this->response->sendJson($id);
        }
    }
    public function addToCart() {
        $userId = $_SESSION['user']['id'];
        $data = $this->request->getBody();
        $productName = $data['productName'];
        $quantity = $data['quantity'];
        $unitPrice = $data['unitPrice'];
        $size = $data['size'];
        $productId = $data['productId'];
        $productImageLink = $data['productImageLink'];
        $productColor = $data['productColor'];
        if ($userId) {
            $existingOrderItem = $this->orderItemService->getExistingOrderItem($userId, $size, $productId,  $productColor);
            if ($existingOrderItem !== false) {
                $orderItemId = $existingOrderItem['id'];
                $newQuantity = $existingOrderItem['quantity'] + (int) $quantity;
                $addToCart = $this->orderItemService->updateOrderItemQuantity($orderItemId, $newQuantity);
            } else {
                $addToCart = $this->orderItemService->addToCart($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId);
            }
            if ($addToCart) {
                $message['isAddToCartSuccess'] = true;
                $message['success'] = 'Successfully added to cart';
            } else {
                $message['isAddToCartSuccess'] = false;
                $message['success'] = 'Failed to add to cart';
            }
        } else {
            $message['isUpdate'] = false;
            $message['error'] = 'Please log in before adding items to the cart';
        }
        $this->response->sendJson($message);
    }

}