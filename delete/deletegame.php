<?php
require '../vendor/autoload.php';
use Vendor\GameStore\Productgame;
use Vendor\GameStore\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {

    $gameId = $_POST['id'];
    $productgame=new Productgame();
    $productgame-> softDeleteGame($gameId);
     header('location:.././Pages/ShowGames.php') ;
       
}


?>