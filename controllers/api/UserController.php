<?php

namespace app\controllers\api;

use app\services\emailService\EmailSender;
use app\services\emailService\OtpEmail;
use app\services\UserService;

class UserController extends BaseController
{
    private $userService;
    private $emailSender;

    public function __construct()
    {
        parent::__construct();
        $this->userService = new UserService();
        $this->emailSender = new EmailSender();
    }

    public function getEmailForgotPassword() {
        $email = $this->request->getBody()['email'];
        $message = [];
        $user = $this->userService->getUserModel()->getUserByEmail($email);
        if ($user) {
            $this->sendOtpCode($email);
            $_SESSION['email'] = $email;
            $message['isSent'] = true;
        } else {
            $message['isSent'] = false;
            $message['error'] = 'This email has not registered an account!!!';
        }
        $this->response->sendJson($message);
    }

    private function sendOtpCode($email)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $otp = '';
        for ($i = 0; $i < 6; $i++) {
            $otp .= $characters[random_int(0, $charactersLength - 1)];
        }
        $emailOtp = new OtpEmail($email, $otp);
        $this->emailSender->sendEmail($email, "user", $emailOtp->subject, $emailOtp->emailContent, $altBody = '');
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_time'] = time();
    }

    public function getOTPCode() {
        $otpCode = $this->request->getBody()['otp'];
        $currentTime = time();
        if ( $otpCode == $_SESSION['otp'] && ($currentTime - $_SESSION['otp_time'] < 60)) {
            $message['isCorrectOtp'] = true;
        } else {
            $message['isCorrectOtp'] = false;
            $message['error'] = 'The OTP code is incorrect or has expired after 60 seconds!!!';
        }
        $this->response->sendJson($message);
    }

    public function saveChangePassword() {
        $data = $this->request->getBody();
        $message = [];
        if (md5($data['currentPassword']) == $_SESSION['user']['password']) {
            $this->userService->saveChangePassword($data, $_SESSION['user']['email']);
            $_SESSION['user']['password'] = md5($data['currentPassword']);
            $message['isUpdate'] = true;
        } else {
            $message['isUpdate'] = false;
            $message['error'] = 'Password is incorrect';
        }
        $this->response->sendJson($message);
    }

    public function getTotalUserByMonthAndYear() {
        $data = $this->request->getBody();
        $month = $data['month'];
        $year = $data['year'];
        $total = $this->userService->getTotalUserByMonthAndYear($month, $year);
        $this->response->sendJson($total);
    }

}