<?php
class EmailSender {
    private $mailer;
    
    public function __construct() {
        $this->mailer = new PHPMailer(true);
        $this->setupMailer();
    }
    
    private function setupMailer() {
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = getenv('SMTP_USER');
        $this->mailer->Password = getenv('SMTP_PASS');
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;
    }
    
    public function sendResetEmail($email, $token) {
        try {
            $resetLink = "http://yourdomain.com/reset-password.php?token=" . $token;
            
            $this->mailer->setFrom('noreply@yourdomain.com', 'Game Store');
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
