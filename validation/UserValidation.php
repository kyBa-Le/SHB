<?php

namespace app\validation;

use app\model\UserModel;

class UserValidation
{

    private array $message = [];
    public function __construct()
    {
        $this->message['isValid'] = false;
        $this->message['errors'] = [];
    }
    public function validateSignUp($user): array
    {
        $errors = array();
        $userModel = new UserModel();
        if (empty($user['email'])) {
            $errors['email'] = 'must not be empty';
        }
        if (empty($user['password'])) {
            $errors['password'] = 'must not be empty';
        }
        if (empty($user['username'])) {
            $errors['name'] = 'must not be empty';
        }
        if (empty($user['fullName'])) {
            $errors['fullName'] = 'must not be empty';
        }
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email';
        }
        var_dump($userModel->getUserByEmail($user['email']));
        if ($userModel->getUserByEmail($user['email']) !== null) {
            $errors['email'] = 'Email already exists';
        }
        if (strlen($user['password']) < 6) {
            $errors['password'] = 'Password should be at least 6 characters';
        }
        if (strlen($user['phone']) !== 10) {
            $errors['phone'] = 'Must be 10 digits number';
        }
        if (count($errors) == 0) {
            $this->message['isValid'] = true;
            var_dump($this->message);
        }
        $this->message['errors'] = $errors;

        return $this->message;
    }

}