<?php
namespace Vendor\GameStore;
use PDO;

class User {
    private $email;
    private $password;
    private $role;

    public function __construct($email, $password) {
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
      
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->role = 'client'; 
    }

    public function save() {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("INSERT INTO users (email, password, role) VALUES (:email, :password, :role)");

            return $stmt->execute([
                ':email' => $this->email,
                ':password' => $this->password,
                ':role' => $this->role
            ]);
        } catch (\PDOException $e) {
            error_log($e->getMessage());
           
        }
    }

    public static function validateLogin($email, $password) {
        try {
            $db = Database::getConnection();
            
            $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND deleted_at IS NULL");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                
                return $user['role'];
            }
            return false;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
           
        }
    }

    public static function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}