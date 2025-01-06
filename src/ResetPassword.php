<?php
namespace Vendor\GameStore;

use PDO;
use Exception;

class ResetPassword {
    private $db;
    private $expiryMinutes = 30;

    public function __construct(PDO $database) {
        $this->db = $database;
    }

    public function generateToken($email) {
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * $this->expiryMinutes);

        $sql = "UPDATE users SET 
                reset_token = ?, 
                reset_token_expiry = ? 
                WHERE email = ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$token_hash, $expiry, $email]);

        return $token;
    }

    public function validateToken($email, $token) {
        $token_hash = hash("sha256", $token);

        $sql = "SELECT * FROM users 
                WHERE email = ? 
                AND reset_token = ? 
                AND reset_token_expiry > NOW()";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email, $token_hash]);
        
        return $stmt->fetch() !== false;
    }

    public function updatePassword($email, $token, $new_password) {
            // if (!$this->validateToken($email, $token)) {
            //     return false;
            // }
        
        $password_hash = password_hash($new_password, PASSWORD_BCRYPT);
        var_dump($password_hash);// hadi  kanpassi lih chno bghina nchof f request n9dro ndiro hka $_REQUEST bach nochof request kamla
        
        $sql = "UPDATE users 
                SET password =?,
                    reset_token = NULL,
                    reset_token_expiry = NULL 
                WHERE email = ?";

        // print_r($sql);
                
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$password_hash, $email]);
    }
}