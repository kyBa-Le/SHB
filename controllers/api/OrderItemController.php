<?php

namespace app\controllers\api;

use app\services\OrderItemService;
use app\services\ProductService;

class OrderItemController extends BaseController
{
    private $orderItemService;
    private $productService;

    public function __construct() {
        parent::__construct();
        $this->orderItemService = new OrderItemService();
        $this->productService = new ProductService();
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
    public function createNewOrderItem() {
        $userId = (int) $_SESSION['user']['id'];
        $data = $this->request->getBody();
        $productName = $data['product_name'] ?? null;
        $quantity = (int) $data['quantity'] ?? null;
        $unitPrice = (int) $data['unit_price'] ?? null;
        $size = $data['size'] ?? null;
        $productId = (int) $data['product_id'] ?? null;
        $productImageLink = $data['product_image_link'] ?? null;
        $productColor = $data['product_color'] ?? null;
        if (isset($data['payment_id']) && !empty($data['payment_id'])) {
            $paymentId = $data['payment_id'];
        } else {
            $paymentId = NULL;
        }
        
        if ($userId) {
            if (!empty($paymentId)) {
                $status = 'Shipping';
                $createNewOrderItem = $this->orderItemService->createOrderItem($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor, $paymentId,  $userId, $status);
                $this->productService->decreaseQuantity($productId, $quantity);
                $this->productService->increasePurchases($productId, 1);
                if ($createNewOrderItem) {
                    $message['message'] = 'Order successfully placed';
                    $message['isCreateNewOrderItem'] = true;
                } else {
                    $message['message'] = 'Order placement unsuccessful';
                    $message['isCreateNewOrderItem'] = false;
                }
            } else {
                $status = 'Pending';
                $idAddedToCart = $this->orderItemService->addToCart($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor, $paymentId, $userId, $status);
                if ($idAddedToCart) {
                    $message['message'] = 'Successfully added to cart';
                    $message['isAddToCartSuccess'] = true;
                } else {
                    $message['message'] = 'Failed to add to cart, please check and try again !';
                    $message['isAddToCartSuccess'] = false;
                }
            }
        } else {
            $message['isUpdate'] = false;
            $message['message'] = 'Please log in and try again !';
        }
        $this->response->sendJson($message);
    }

    public function updateOrderItem($id) {
        $data = $this->request->getBody();
        $status = 'Shipping';
        $paymentId = $data['payment_id'];
        $updateOrderItem = $this->orderItemService->updateOrderItem($paymentId, $status, $id);
        $orderItem = $this->orderItemService->getOrderItemById($id);
        $this->productService->decreaseQuantity($orderItem['product_id'], $orderItem['quantity']);
        if ($updateOrderItem) {
                $message['message'] = 'Order successfully placed';
                $message['isCreateNewOrderItem'] = true;
            } else {
                $message['message'] = 'Order placement unsuccessful';
                $message['isCreateNewOrderItem'] = false;
        }
        $this->response->sendJson($message);
    }

    public function getTotalOrderItemQuantityAndMonthAndYear() {
        $data = $this->request->getBody();
        $month = $data['month'];
        $year = $data['year'];
        $total = $this->orderItemService->getTotalOrderItemQuantityByMonthAndYear($month, $year);
        $this->response->sendJson($total);
    }
    public function getAllOrderItems() {
        $orderItems = $this->orderItemService->getAllOrderItems();
        $this->response->sendJson($orderItems);
    }
    public function updateOrderByPaymentId() {
        $data = $this->request->getBody();
        $status = 'Delivered';
        $paymentId = $data['payment_id'];
        $updateOrderItem = $this->orderItemService->updateOrderByPaymentId($paymentId, $status);
        if ($updateOrderItem) {
                $message['isUpdate'] = true;
            } else {
                $message['isUpdate'] = false;
        }
        $this->response->sendJson($message);
    }


    public function getPurchaseOfProductsInLast30Days() {
        $data = $this->orderItemService->getPurchaseOfProductsInLast30Days();
        $this->response->sendJson($data);
    }
}