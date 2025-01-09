<?php
namespace Vendor\GameStore;

class Game {
    public $name;
    public $description;
    public $image;
    public $price;
    public $stock;

    public function __construct($name, $description, $image, $price, $stock) {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->stock = $stock;
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