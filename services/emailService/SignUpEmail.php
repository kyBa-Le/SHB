<?php

namespace app\services\emailService;

class SignUpEmail
{
    public string $emailContent ;
    public string $subject = "Welcome to SHB";
    public function __construct($username)
    {
        $this->emailContent = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Welcome to SHB</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .email-container {
                    max-width: 600px;
                    margin: 20px auto;
                    background: #ffffff;
                    padding: 20px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .header h1 {
                    color: #4CAF50;
                    font-size: 24px;
                }
                .content {
                    color: #333;
                }
                .footer {
                    text-align: center;
                    margin-top: 20px;
                    font-size: 14px;
                    color: #777;
                }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='header'>
                    <h1>Welcome to SHB store!</h1>
                </div>
                <div class='content'>
                    <p>Dear <strong>$username</strong>,</p>
                    <p>Thank you for registering on <strong>SHB Store</strong>. We're thrilled to have you join our community!</p>
                    <p>Explore our features, connect with others, and make the most of your experience on SHB Store.</p>
                    <p>If you have any questions or need assistance, feel free to reach out to our support team.</p>
                    <p>Have a great day!</p>
                </div>
                <div class='footer'>
                    <p>&copy; " . date("Y") . " SHB. All rights reserved.</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }
}