<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';


class SendEmail{
    private $mailer;
    public function __construct() {
    $this->mailer=new PHPMailer(true);
    $this->stepMailer();
        
    }
    public function stepMailer(){
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = getenv('hamzaelboukri01@gmail.com');
        $this->mailer->Password = getenv('phpmailer');
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;      
    }

    public function sendResetEmail($email, $token) {
        try {
            $resetLink = "http://hamzaelboukri01@gmail.com/reset-password.php?token=" . $token;
            
            $this->mailer->setFrom('hamzaelboukri01@gmail.com');
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



?>