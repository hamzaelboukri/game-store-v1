<?php

$email= $_POST["email"];
$token=bin2hex(random_bytes(16));
$token_hash =hash("sha256",$token);

$expir= date("Y-m-d H:i:s" , time()+60*30);
 

?>

<?php
class ResetPassword{

    private $db;
    private $expirTime=30;

    
    public function __construct($database) {
        $this->db = $database;
    }

    public function gnerettoken($email){

        
$token=bin2hex(random_bytes(16));
$token_hash =hash("sha256",$token);

$expir= date("Y-m-d H:i:s" , time()+60*30);
$db = Database::getConnection();

$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * $this->expiryMinutes);

$sql = "INSERT INTO users (email, token_hash, expiry)
        VALUES (?, ?, ?)";
        
$stmt = $this->db->prepare($sql);
$stmt->execute([$email, $token_hash, $expiry]);



}

public function ValidtionToken($email, $token_hash){

    $token_hash =hash("sha256",$token);

    $sql= " SELECT * FROM users
    WHERE email = ? AND token_hash = ? AND expiry > NOW()
                AND used = 0 LIMIT 1";
                $stmt=$this->db->prepare($sql);
                $stmt->execute([$email, $token_hash]);
}


public function updetpass($eamil,$token ,$new_password)   {

    if (!ValidtionToken($email, $token_hash)) {
        return false ;
      
    }    
}
}
?>
