<?php
namespace Vendor\GameStore;

class Game {
    public $id;
    public $name;
    public $description;
    public $image;
    public $price;
    public $stock;

    public function __construct( $name, $description, $image, $price, $stock ,$id=null) {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->stock = $stock;
        $this->id=$id;
    }


    // public function getName() {
    //     return $this->name;
    // }

    // public function getDescription() {
    //     return $this->description;
    // }

    // public function getImage() {
    //     return $this->image;
    // }

    // public function getPrice() {
    //     return $this->price;
    // }

    // public function getStock() {
    //     return $this->stock;
    // }
}
?>