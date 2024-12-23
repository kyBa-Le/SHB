<?php

namespace app\controller;

use app\core\Application;
use app\thirdPartyService\EmailSender;
use app\thirdPartyService\OtpEmail;


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
        $this->productColorsController = new ProductColorsController();
        $this->orderItemController = new OrderItemController();
    }

    public function getProducts() {
        $category = $this->request->getBody()['category'];
        $pageNo = $this->request->getBody()['pageNo'];
        $pageSize = $this->request->getBody()['pageSize'];
        $products = $this->productController->getProductsByCondition($category, $pageNo, $pageSize);
        $this->response->sendJson($products);
    }

    public function getEmailForgotPassword() {
        $email = $this->request->getBody()['email'];
        $message = [];
        $user = $this->userController->getUserModel()->getUserByEmail($email);
        if ($user) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $otp = '';
            for ($i = 0; $i < 6; $i++) {
                $otp .= $characters[random_int(0, $charactersLength - 1)];
            } 
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_time'] = time();
            $emailOtp = new OtpEmail($email, $otp);
            $this->emailSender->sendEmail($email, "user", $emailOtp->subject, $emailOtp->emailContent, $altBody = '');
            $_SESSION['email'] = $email;
            $message['isSent'] = true;
        } else {
            $message['isSent'] = false;
            $message['error'] = 'This email has not registered an account!!!';
        }
        $this->response->sendJson($message);
    }

    public function getOTPCode() {
        $otpCode = $this->request->getBody()['otp'];
        $currentTime = time();
        if ( $otpCode == $_SESSION['otp'] && ($currentTime - $_SESSION['otp_time'] < 60)) {

            $message['isCorrectOtp'] = true;
        } else {
            $message['isCorrectOtp'] = false;
            $message['error'] = 'The OTP code is incorrect or has expired after 60 seconds!!!';
        }
        $this->response->sendJson($message);
    }
    
    public function saveChangePassword() {
        $data = Application::$app->request->getBody();
        $message = [];
        if (md5($data['currentPassword']) == $_SESSION['user']['password']) {
            $this->userController->saveChangePassword($data, $_SESSION['user']['email']);
            $_SESSION['user']['password'] = md5($data['currentPassword']);
            $message['isUpdate'] = true;
        } else {
            $message['isUpdate'] = false;
            $message['error'] = 'Password is incorrect';
        }
        $this->response->sendJson($message);
    }

    public function getDetailedProduct(){
        $id = Application::$app->request->getBody()['product-id'];
        $product = $this->productController->getProductById($id);
        $this->response->sendJson($product);
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
            $addToCart = $this->orderItemController->addToCart($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId);
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