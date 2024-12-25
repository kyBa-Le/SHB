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

    public function updateOrderItemQuantityById($id)
    {
        if ($_SESSION['user']) {
            $data = $this->request->getBody();
            $quantity = $data['quantity'];
            $orderItem = $this->orderItemService->updateOrderItemQuantity($id, $quantity);
            $this->response->sendJson($orderItem);
        }
    }

    public function deleteOrderItemById($id)
    {
        if ($_SESSION['user']) {
            $this->orderItemService->deleteOrderItem($id);
            $this->response->sendJson($id);
        }
    }
    public function addToCart() {
        $userId = (int) $_SESSION['user']['id'];
        $data = $this->request->getBody();
        $productName = $data['productName'];
        $quantity = (int) $data['quantity'];
        $unitPrice = (int) $data['unitPrice'];
        $size = $data['size'];
        $productId = (int) $data['productId'];
        $productImageLink = $data['productImageLink'];
        $productColor = $data['productColor'];
        if ($userId) {
            $idAddedToCart = $this->orderItemService->addToCart($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor, $userId);
            if ($idAddedToCart) {
                $message['message'] = 'Successfully added to cart';
                $message['isAddToCartSuccess'] = true;
            } else {
                $message['message'] = 'Failed to add to cart, please check and try again !';
                $message['isAddToCartSuccess'] = false;
            }
        } else {
            $message['isUpdate'] = false;
            $message['message'] = 'Please log in before adding items to the cart';
        }
        $this->response->sendJson($message);
    }

}