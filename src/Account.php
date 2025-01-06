<?php
namespace account ;
 class account {

    private $email;
    private $STATUSE;

    public function __construct(){
         $this->email = $email;
         $this ->STATUSE = $STATUSE;
    
    }

    public function getemail(){
       return $this-> $email;


    }
    public function aficher (){
        try {

            $db = Database::getConnection();
            $sql= $stmt = $db->prepare(" SELECT * FROM users (email, STATUSE, ) VALUES (:email, :STATUSE)");

            return $stmt->execute ([
                ':email' =>$this->email,
                'STATUSE' => $this->STATUSE
            ]);
            $users = $stmt->fetchAll();//2D array

            $data = [];
            foreach ($products as $product) {
                $data[] = new Product($product['id'], $product['name'], $product['description'], $product['price'], $product['quantity']);
            }
            return $data;//[Product, Product, Product, Product]

        }catch (\PDOException $e) {
            error_log($e->getMessage());
           
        }
        



}




 }

?>