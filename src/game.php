<?php

class game{
  
    private $Name;
    private $describtion;
    private $price;
    private $stock;


    public function __consterct($Name,$describtion,$price,$stock, ){
         $this->Name=$Name;
         $this->describtion=$describtion;
         $this->price=$price;
         $this->stock=$stock;
    }

    public function getName(){

        return $this->$Name;

    }
    public function getDescribtion(){
        return $this->$describtion;
    }
    public function getPrice(){
        return $this ->$price;
        
    }

    public function getStock(){
        return $this ->$stock;
        
    }


    public static function addGame(){

        $db=Database::getConnection() ;

        $stm



    }
    
}


?>