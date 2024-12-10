<?php

namespace app\controller;

use app\core\Controller;

class SiteController extends Controller
{
    public function home() {
        $productController = new ProductController();
        $data = ['outStandingProducts' => $productController->getTop4OutStandingProducts()];
        return $this->render('home', $data);
    }

    public function signUp() {
        $request = new Request();
        $data = $request->getBody();
        $userController = new UserController();
        $message = $userController->signUp($data);
        if ($message['isValid']) {
            return $this->render('signUpSuccess', ['message' => $message]);
        }
        else {
            return $this->render('signUp', ['message' => $message]);
        }
    }
}