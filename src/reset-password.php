<?php
class ResetPassword {
    private $db;
    private $expiryMinutes = 30;

    public function __construct($database) {
        $this->db = $database;
    }

    public function generateToken($email) {
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * $this->expiryMinutes);

        $sql = "INSERT INTO password_reset (email, token_hash, expiry)
                VALUES (?, ?, ?)";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email, $token_hash, $expiry]);
        
        return $token;
    }

    public function validateToken($token, $email) {
        $token_hash = hash("sha256", $token);
        
        $sql = "SELECT * FROM password_reset 
                WHERE email = ? AND token_hash = ? AND expiry > NOW()
                AND used = 0 LIMIT 1";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email, $token_hash]);
        
        return $stmt->rowCount() > 0;
    }

    public function updatePassword($email, $token, $new_password) {
        if (!$this->validateToken($token, $email)) {
            return false;
        }

        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$password_hash, $email]);

        // token
        $sql = "UPDATE password_reset SET used = 1 
                WHERE email = ? AND token_hash = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email, hash("sha256", $token)]);
        
        return true;
    }
}
