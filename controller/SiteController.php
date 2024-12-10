<?php

namespace app\controller;

use app\core\Controller;
use app\core\Request;

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
        if ($message['isValid']) {
            return $this->render('signUpSuccess', ['message' => $message]);
        }
        else {
            return $this->render('signUp', ['message' => $message]);
        }
    }
}