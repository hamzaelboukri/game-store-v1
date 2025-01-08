<?php
namespace Vendor\GameStore;


class game{
  
    private $Name;
    private $describtion;
    private $image;
    private $price;
    private $stock;


    public function __consterct($Name,$describtion ,$image,$price,$stock, ){
         $this->Name=$Name;
         $this->describtion=$describtion;
         $this->image=$image;
         $this->price=$price;
         $this->stock=$stock;
    }

    public function getName(){

        return $this->$Name;

    }
    public function getDescribtion(){
        return $this->$describtion;
    }

    public function getImage(){
        return $this->$image;
    }
    public function getPrice(){ 
        return $this ->$price;
        
    }

    public function getStock(){
        return $this ->$stock;
        
    }


    

     


    }
    



?>