<?php
require 'vendor/autoload.php';
use Vendor\GameStore\Database;
use Vendor\GameStore\ResetPassword;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $password = $_POST['new-password'];
    
    $resetPassword = new ResetPassword(Database::getConnection());
    
    if ($resetPassword->updatePassword($email, $token, $password)) {
       
        $_SESSION['success'] = "success";
        header('Location: index.php');
        exit(); 
    } else {
        $_SESSION['error'] = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset and Logout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <!-- Password Reset Form -->
        <div class="form-wrapper">
            <h2>Reset Password</h2>
            <form action="Reset_Password.php" method="POST">
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
    <input type="password" name="new-password" placeholder="Enter new password" required>
    <button type="submit" class="button">Reset Password</button>
</form>
          
        </div>
    </div>
</body>
</html>
