
<?php
require 'vendor/autoload.php'; 
use Vendor\GameStore\User; 
use Vendor\GameStore\Database;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $user = new User(
            $_POST['email'],
            $_POST['password']
        );
        
      $user->save();
         }
    }


?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>game store</title>
 
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="" >
        <input type="email" placeholder="Enter your email" name="email1">
        <input type="password" placeholder="Enter your password"  name="password1">
        <a href="#">Forgot password?</a>
        <input type="button" class="button" value="Login">
      </form>
      <div class="signup">
        <span class="signup">Don't have an account?
         <label for="check">Signup</label>
        </span>
      </div>
    </div>
    <div class="registration form">
      <header>Signup</header>
      <form action="#">
        <input type="email" placeholder="Enter your email" name="email">
        <input type="password" placeholder="Create a password" name="password">
        <input type="password" placeholder="Confirm your password" name="password-2">
        <input type="button" class="button" value="Signup">
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