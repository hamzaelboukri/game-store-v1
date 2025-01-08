<?php
 namespace Vendor\GameStore;

class Productgame{



    public function displayer(){

    }



public static function uploadImage($imageFile) {
    $targetDir = "uploads/";
    $imageName = time() . '_' . basename($imageFile["name"]); 
    $targetFile = $targetDir . $imageName;
    if (move_uploaded_file($imageFile["tmp_name"], $targetFile)) {
        return $targetFile; 
    } else {
        echo "There was an error uploading the image.";
        return false;
    }
}



public static function addGame($name, $description, $image, $price, $stock) {
    try {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "INSERT INTO products (name, description, image_url, price, stock) 
             VALUES (:name, :description, :image, :price, :stock)"
        );
        $stmt->execute([    
            ':name' => $name,
            ':description' => $description,
            ':image' => $image,
            ':price' => $price,
            ':stock' => $stock,
        ]);
        echo "Produit ajouté avec succès dans la base de données !";
    } catch (\PDOException $e) {
       
        echo "Erreur lors de l'ajout du produit : " . $e->getMessage();
    }
}
}
?>