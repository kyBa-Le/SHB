<?php

namespace app\controllers\api;

use app\controllers\ProductColorsController;
use app\controllers\ProductController;
use app\controllers\UserController;
use app\core\Application;
use app\services\emailService\EmailSender;
use app\services\emailService\OtpEmail;


class Rest
{
    private $productController;
    private $emailSender;
    private $userController;
    private $productColorsController;
    private $request;
    private $response;
    private $orderItemController;
    public function __construct() {
        $this->request = Application::$app->request;
        $this->response = Application::$app->response;
        $this->productController = new ProductController();
        $this->emailSender = new EmailSender();
        $this->userController = new UserController();
//        $this->productColorsController = new ProductColorsController();
//        $this->orderItemController = new OrderItemController();
    }

    public function getColors() {
        $productId = $this->request->getBody()['product-id'];
        $productColors = $this->productColorsController->getProductColorsByProductId($productId);
        $this->response->sendJson($productColors);
    }
    public function getOrderItemsByUserId() {
        $id = $_SESSION['user']['id'];
        $orderItems = $this->orderItemController->getOrderItemsByUserId($id);
        $this->response->sendJson($orderItems);
    }

    public function updateOrderItemQuantityById()
    {
        if ($_SESSION['user']) {
            $data = $this->request->getBody();
            $id = $data['id'];
            $quantity = $data['quantity'];
            $orderItem = $this->orderItemController->updateOrderItemQuantity($id, $quantity);
            $this->response->sendJson($orderItem);
        }
    }

    public function deleteOrderItemById()
    {
        if ($_SESSION['user']) {
            $id = $this->request->getBody()['id'];
            $this->orderItemController->deleteOrderItem($id);
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
        if ($userId == true) {
            $existingOrderItem = $this->orderItemController->getExistingOrderItem($userId, $size, $productId,  $productColor);
            if ($existingOrderItem !== false) {
                $orderItemId = $existingOrderItem['id'];
                $newQuantity = $existingOrderItem['quantity'] + (int) $quantity;
                $addToCart = $this->orderItemController->updateOrderItemQuantity($orderItemId, $newQuantity);
            } else {
                $addToCart = $this->orderItemController->addToCart($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId);
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