<?php
require 'vendor/autoload.php';
use Vendor\GameStore\User;
use Vendor\GameStore\Database;

session_start();

$error = '';
$success = '';

//  Sing up
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    try {
        if ($_POST['password'] !== $_POST['password-2']) {
            throw new Exception("Passwords do not match");
        }
        
        $user = new User($_POST['email'], $_POST['password']);
        if ($user->save()) {
            $success = "Registration successful! Please login.";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

//  Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    try {
        $role = User::validateLogin($_POST['email1'], $_POST['password1']);
        if ($role) {
            header('Location: ' . ($role === 'admin' ? 'admin_page.php' : 'user_page.php'));
            exit;
        } else {
            $error = "Invalid credentials";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <input type="checkbox" id="check">
        <div class="login form">
            <header>Login</header>
            <form method="POST" action="">
                <input type="email" placeholder="Enter your email" name="email1" required>
                <input type="password" placeholder="Enter your password" name="password1" required>
                <a href="forgetpass.php">Forgot password?</a>
                <input type="hidden" name="login" value="1">
                <button type="submit" class="button">Login</button>
            </form>
            <div class="signup">
                <span class="signup">Don't have an account?
                    <label for="check">Signup</label>
                </span>
            </div>
        </div>
        <div class="registration form">
            <header>Signup</header>
            <form method="POST" action="">
                <input type="email" placeholder="Enter your email" name="email" required>
                <input type="password" placeholder="Create a password" name="password" required>
                <input type="" placeholder="Confirm your password" name="password-2" required>
                <input type="hidden" name="register" value="1">
                <button type="submit" class="button">Register</button>
            </form>
            <div class="signup">
                <span class="signup">Already have an account?
                    <label for="check">Login</label>
                </span>
            </div>
        </div>
    </div>
</body>
</html>