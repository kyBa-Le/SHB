<?php

namespace app\controller;

use app\model\UserModel;
use app\validation\UserValidation;

class UserController
{
    private $userModel;
    private $userValidation;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userValidation = new UserValidation();
    }

    public function signUp($data) {
        $message = $this->userValidation->validateSignUp($data);
        if ($message['isValid']) {
            $email = $data['email'];
            $username = $data['username'];
            $password = $data['password'];
            $fullName = $data['fullName'];
            $phone = $data['phone'];
            $province = $data['province'];
            $district = $data['district'];
            $detailed_address = $data['detailed_address'];
            $this->userModel->saveUser($email, $username, md5($password), $fullName, $phone, $province, $district, $detailed_address);
            return ['isSuccess' => true];
        }else {
            $message['isSuccess'] = false;
            return $message;
        }
    }

    public function login($data) {
        $email = $data['email'];
        $password = $data['password'];
        $user = $this->userModel->getUserByEmailAndPassword($email, md5($password));
        if ($user !== false) {
            $_SESSION['user'] = $user;
            $_SESSION['login_time'] > 10 * 24 * 60 * 60;
            return ['isLoggedIn' => true];
        }else {
            return ['isLoggedIn' => false];
        }
    }  
}