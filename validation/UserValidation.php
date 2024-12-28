<?php

namespace app\validation;

use app\models\UsersModel;

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
        $userModel = new UsersModel();
        if (empty($user['email'])) {
            $errors['email'] = 'must not be empty';
        }
        if (empty($user['password'])) {
            $errors['password'] = 'must not be empty';
        }
        if (empty($user['username'])) {
            $errors['name'] = 'must not be empty';
        }
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email';
        }
        if ($userModel->getUserByEmail($user['email']) !== false) {
            $errors['email'] = 'Email already exists';
        }
        if (strlen($user['password']) < 6) {
            $errors['password'] = 'Password should be at least 6 characters';
        }
        if ($user['phone'] !=null && !ctype_digit($user['phone'])) {
            $errors['phone'] = 'Phone number must be a 10-digit number.';
        }
        if (count($errors) == 0) {
            $this->message['isValid'] = true;
        }
        $this->message['errors'] = $errors;
        return $this->message;
    }

}