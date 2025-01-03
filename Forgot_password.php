<?php

require 'vendor/autoload.php';
use Vendor\GameStore\Database;
use Vendor\GameStore\ResetPassword; 

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email-send'])) {
    try {
        $email = filter_var($_POST['email-send'], FILTER_VALIDATE_EMAIL);
        if (!$email) {
            throw new Exception("Invalid email address");
        }

        $resetPassword = new ResetPassword(Database::getConnection());
        $token = $resetPassword->generateToken($email);

        $mailer = new SendEmail();
        if ($mailer->sendResetEmail($email, $token)) {
            $_SESSION['success'] = "Reset instructions sent to your email";
        } else {
            throw new Exception("Failed to send reset email");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header("Location: Forgot_password.php");
    exit();
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">        
        <input type="checkbox" id="check">
        <div class="login form">
            <header></header>
            <form method="POST" action="">
                <input type="email" placeholder="Enter your email" name="email-send" required>
                <button type="submit" class="button">send</button>
            </form>


        </body>
</html>