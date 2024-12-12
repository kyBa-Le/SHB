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
}