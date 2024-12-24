<?php

namespace app\services;

use app\models\UserModel;
use app\validation\UserValidation;

class UserService
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
            $province = $data['province'] ?? '';
            $district = $data['district'] ?? '';
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
            $_SESSION['login_time'] = time();
            return ['isLoggedIn' => true];
        }else {
            return ['isLoggedIn' => false];
        }
    }

    public function editProfile($data) {
        $userId = $_SESSION['user']['id'];
        $username = $data['username'];
        $fullName = $data['fullName'];
        $phone = $data['phone'];
        $province = $data['province'];
        $district = $data['district'];
        $detailed_address = $data['detailed_address'];
        $updateUser = $this->userModel->updateUserById($username, $fullName,  $phone,  $province, $district, $detailed_address, $userId);
        if ($updateUser !== false) {
            $user = $this->userModel->getUserById($userId);
            $_SESSION['user'] = $user;
            $_SESSION['login_time'] = time();
            return ['isEdited' => true];
        }else {
            return ['isEdited' => false];
        }
    }

    public function getUserModel() {
        return $this->userModel;
    }

    public function saveNewPassword($data) {
        $email = $_SESSION['email'];
        $newPassword = $data['newPassword'];
        $this->userModel->updatePasswordByEmail($email, md5($newPassword ));
    }

    public function editAvatarLink($link, $userId){
        $this->userModel->changeAvatar($link, $userId);
        $user = $this->userModel->getUserById($userId);
        $_SESSION['user'] = $user;
        $_SESSION['login_time'] = time();
    }

    public function saveChangePassword($data, $email) {
        return $this->userModel->updatePasswordByEmail($email, md5($data['newPassword'] ));
    }
}