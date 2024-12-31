<?php

class User {
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

class Client {
    public function validateLogin() {
        try {
            $db = Database::getConnection(); 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email1'];
                $password = $_POST['password1'];
             
                $sql = "SELECT * FROM users WHERE email = :email";
                $stmt = $db->prepare($sql);
                $stmt->execute([':email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        if ($user['role'] == 'user') {
                            header('Location: user_page.php');
                            exit;
                        } else {
                            header('Location: admin_page.php'); 
                            exit;
                        }
                    } else {
                      
                        return false;
                    }
                } else {
                    
                    return false;
                }
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
