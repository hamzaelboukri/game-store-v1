<?php
namespace Vendor\GameStore;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendEmail {
    private $mailer;
    
    public function __construct() {
        $this->mailer = new PHPMailer(true);
        $this->setupMailer();
    }
 
    private function setupMailer() {
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.gmail.com';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = 'hamzaelboukri01@gmail.com';
            $this->mailer->Password = 'kwbf vohy toxo ydnu'; 
            $this->mailer->SMTPSecure = 'tls';
            $this->mailer->Port = 587;
            echo "test";
        } catch (Exception $e) {
            error_log("Mailer setup failed: " . $e->getMessage());
            throw new Exception("Email setup failed");
        }
    }

    public function sendResetEmail($email, $token) {
        try {
            $resetLink = "http://localhost/game%20store%20v1/Reset_Password.php?token=" . $token . "&email=" . urlencode($email);
            
            $this->mailer->clearAddresses(); 
            $this->mailer->setFrom('hamzaelboukri01@gmail.com', 'Game Store');
            $this->mailer->addAddress($email);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Password Reset Request';
            $this->mailer->Body = "
                <h2>Password Reset Request</h2>
                <p>Click the link below to reset your password:</p>
                <p><a href='{$resetLink}'>{$resetLink}</a></p>
                <p>This link will expire in 30 minutes.</p>
                <p>If you didn't request this, please ignore this email.</p>
            ";
            
            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Email sending failed: " . $e->getMessage());
            return false;
        }
    }
}