<?php

namespace app\controller;

use app\core\Application;
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
  
    public function editProfile($data) {
        $request = new Request();
        $data = $request->getBody();        
        $imageUploaded = $this->saveImage('file_uploaded', 'images/avatar/');
        if ($imageUploaded != false){
            $userId = $_SESSION['user']['id'];
            $this->userController->editAvatarLink( $imageUploaded, $userId);
            header('Location: /user/edit');
            exit;
        }
        $message = $this->userController->editProfile($data);
        $message['data'] = $data;
        if ($message['isEdited']) {
            header('Location: /user/edit');
            exit;
        }
        return $this->render('test', $message);
    }

    public function saveNewPassword($data) {
        $request = new Request();
        $data = $request->getBody();
        $message = $this->userController->saveNewPassword($data);
        $message['data'] = $data;
        return $this->render('/login', $message);
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
        } else {
            return false;
        }
    }


    public function search() {
        $name = Application::$app->request->getBody()['product-name'];
        $products = $this->productController->getProductByName($name);
        $data = ['products' => $products];
        return $this->render('searchProduct', $data);
    }

    public function detail() {
        return $this->render('detailProducts', []);
    }
}