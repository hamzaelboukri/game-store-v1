<?php
namespace Vendor\GameStore;

class User {
    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function save() {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");

            return $stmt->execute([
                ':email' => $this->email,
                ':password' => $this->password
            ]);
        } catch (PDOException $e) {
           
            error_log($e->getMessage());
            return false;
        }
    }

    public static function validateLogin() {
        try {
            $db = Database::getConnection();
            
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $email = $_POST['email1'] ?? null;
                $password = $_POST['password1'] ?? null;

                if (!$email || !$password) {
                    return false; 
                }

                $sql = "SELECT * FROM users WHERE email = :email";
                $stmt = $db->prepare($sql);
                $stmt->execute([':email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    if ($user['role'] === 'user') {
                        header('Location: user_page.php');
                        exit;
                    } elseif ($user['role'] === 'admin') {
                        header('Location: admin_page.php');
                        exit;
                    }
                }
            }

            return false; 
        } catch (PDOException $e) {
           
            error_log($e->getMessage());
            return false;
        }
    }
}
