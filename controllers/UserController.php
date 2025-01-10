<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\UsersModel;
use app\services\emailService\EmailSender;
use app\services\emailService\SignUpEmail;
use app\services\UserService;
use app\validation\UserValidation;
use Cloudinary\Cloudinary;

class UserController extends Controller
{
    private $userService;
    private $cloudinary;
    public function __construct()
    {
        $this->userService = new UserService();
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
                'api_key'    => $_ENV['CLOUDINARY_API_KEY'],
                'api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
            ],
        ]);
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
        session_destroy();
        session_start();
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
        $imageUploaded = $this->saveImage('file_uploaded', 'images-avatar');
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

    private function saveImage($fieldName, $uploadPreset) {
        // Kiểm tra xem file đã được upload chưa
        if (isset($_FILES[$fieldName])) {

            $fileTmpPath = $_FILES[$fieldName]['tmp_name'];

            $result = $this->cloudinary->uploadApi()->upload($fileTmpPath, [
                'upload_preset' => $uploadPreset,
            ]);

            // Trả về URL của ảnh
            return $result['secure_url'];
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