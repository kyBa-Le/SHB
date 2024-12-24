<?php

namespace app\services\emailService;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailSender
{
    private PHPMailer $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);

        try {
            // Cấu hình SMTP
            $this->mailer->isSMTP();
            $this->mailer->Host       = 'smtp.gmail.com';
            $this->mailer->SMTPAuth   = true;
            $this->mailer->Username   = 'kb.mytodo@gmail.com';
            $this->mailer->Password   = 'bbme gynk zzvy qafv';
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port       = 587;
            $this->mailer->isHTML(true);

            // Cài đặt thông tin mặc định cho người gửi
            $this->mailer->setFrom($this->mailer->Username, 'SHB Store');
        } catch (Exception $e) {
            throw new Exception("Mailer configuration error: " . $e->getMessage());
        }
    }

    public function sendEmail($toEmail, $toName, $subject, $body, $altBody = ''): string
    {
        try {
            // Thông tin người nhận
            $this->mailer->addAddress($toEmail, $toName);

            // Nội dung email
            $this->mailer->isHTML(true); // Gửi email ở dạng HTML
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;
            $this->mailer->AltBody = $altBody;

            // Gửi email
            $this->mailer->send();
            return "Email sent successfully to $toEmail.";
        } catch (Exception $e) {
            return "Email could not be sent. Error: {$this->mailer->ErrorInfo}";
        }
    }
}