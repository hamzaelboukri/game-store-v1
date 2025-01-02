<?php
require 'vendor/autoload.php';
use Vendor\GameStore\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $password = $_POST['password'];
    
    $resetPassword = new ResetPassword(Database::getConnection());
    if ($resetPassword->updatePassword($email, $token, $password)) {
        header('Location: index.php?msg=password-updated');
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
            <form action="reset-password.php" method="POST">
                <label for="new-password">New Password</label>
                <input type="password" id="new-password" name="new-password" placeholder="Enter new password" required>

                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm new password" required>

                <button type="submit" class="btn">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html>
