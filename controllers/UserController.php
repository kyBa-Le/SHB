<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\UsersModel;
use app\services\emailService\EmailSender;
use app\services\emailService\SignUpEmail;
use app\services\UserService;
use app\validation\UserValidation;

class UserController extends Controller
{
    private $userModel;
    private $userValidation;
    private $userService;
    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->userValidation = new UserValidation();
        $this->userService = new UserService();
    }

    public function signUp() {
        $request = new Request();
        $data = $request->getBody();
        $message = $this->userService->signUp($data);
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
        $message = $this->userService->login($data);
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

    public function editProfile() {
        $request = new Request();
        $data = $request->getBody();
        $imageUploaded = $this->saveImage('file_uploaded', 'images/avatar/');
        if ($imageUploaded){
            $userId = $_SESSION['user']['id'];
            $this->userService->editAvatarLink( $imageUploaded, $userId);
            header('Location: /user/edit');
            exit;
        }
        $message = $this->userService->editProfile($data);
        $message['data'] = $data;
        if ($message['isEdited']) {
            header('Location: /user/edit');
            exit;
        }
        return $this->render('editProfile', $message);
    }

    private function saveImage($fieldName, $path){
        if (isset($_FILES[$fieldName])) {
            $fileTmpPath = $_FILES[$fieldName]['tmp_name'];
            $originalFileName = $_FILES[$fieldName]['name'];
            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $newFileName = uniqid('file_', true) . '.' . $fileExtension;
            $uploadFolder = $path;
            $destinationPath = $uploadFolder . $newFileName;
            if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                return $destinationPath;
            }
        }
        return false;
    }

    public function saveNewPassword() {
        $request = new Request();
        $data = $request->getBody();
        $this->userService->saveNewPassword($data);
        $message['data'] = $data;
        return $this->render('login', $message);
    }

}