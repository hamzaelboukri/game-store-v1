
<?php
include_once 'conn.php';
include_once 'ValidtionEmail.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $user = new user(
            $_POST['email'],
            $_POST['password']
        );



        
        
        if ($user->save()) {
            header('Location: index.php?success=1'); 
            exit(); 
        } else {
            header('Location: index.php?error=1');   
            exit();
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        
        <button type="submit">Save</button> 
    </form>
    
</body>
</html>
