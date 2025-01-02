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
    
    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        
    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$password_hash, $email]);

    // Mark token as used
    $sql = "UPDATE password_reset SET used = 1 
            WHERE email = ? AND token_hash = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$email, hash("sha256", $token)]);
}
}
?>
