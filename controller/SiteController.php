<?php

namespace app\controller;

use app\core\Controller;
use app\core\Request;
use app\thirdPartyService\EmailSender;
use app\thirdPartyService\SignUpEmail;

class SiteController extends Controller
{
    private $productController;
    private $userController;

    public function __construct() {
        $this->productController = new ProductController();
        $this->userController = new UserController();
    }

    public function home() {
        $data = ['outStandingProducts' => $this->productController->getTop4OutStandingProducts()];
        return $this->render('home', $data);
    }

    public function signUp() {
        $request = new Request();
        $data = $request->getBody();
        $message = $this->userController->signUp($data);
        $message['data'] = $data;
        if ($message['isSuccess']) {
            $emailSender = new EmailSender() ;
            $signUpEmail = new SignUpEmail($data['username']);
            $emailSender->sendEmail($data['email'], $data['username'], $signUpEmail->subject, $signUpEmail->emailContent);
            header('Location: /sign-up/success');
            exit;
        }
        return $this->render('signUp', $message);
    }

    public function login() {
        $request = new Request();
        $data = $request->getBody();
        $message = $this->userController->login($data);
        $message['data'] = $data;
        if ($message['isLoggedIn']) {
            header('Location: /');
            exit;
        }
        return $this->render('login', $message);
    }
    public function logout() {
        session_destroy();
        header('Location: /');
    }
    public function editProfile($data) {
        $request = new Request();
        $data = $request->getBody();
        $message = $this->userController->editProfile($data);
        $message['data'] = $data;
        if ($message['isEdited']) {
            header('Location: /user/edit');
            exit;
        }
        return $this->render('test', $message);
    }
    private function product($category) {
        $products = $this->productController->getProductsByCondition($category, 1, 6);
        $data = ['products' => $products, 'category' => $category];
        return $this->render('product', $data);
    }

    public function women() {
        return $this->product('Women');
    }

    public function men() {
        return $this->product('Men');
    }

    public function children() {
        return $this->product('Children');
    }
}
