
<?php
include_once 'conn.php';
include_once 'class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if(isset($_POST['email']) && isset($_POST['password'])) {
  $user = new  user(
     $_POST['email'],
     $_POST['password']
   );
};

if($user->save()){

   header ('location :index.php?sucses=1 ');
      }

      else {
         header ('location :index.php?fels ');

        
      }

   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>

  <form action="" method="post">


  <label for="">email</label>
  <input type="email" name="email">
  <label for="">password</label>
  <input type="password" name="password">
  <button type="submit">save</button>
  </form>



   
</body>
</html>