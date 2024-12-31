<?php

class user {
    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->email = $email;       
           $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function save() {
        try {
            $db = Database::getConnection(); 
            $stmt = $db->prepare("INSERT INTO users (email, password) 
                                VALUES (:email, :password)");  
            
            return $stmt->execute([
                ':email' => $this->email,     
                ':password' => $this->password 
            ]);
        } catch (PDOException $e) {
         
            return false;
        }
    }
}

?>





?>