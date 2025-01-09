<?php
 namespace Vendor\GameStore;

class Productgame{

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
        
    } catch (\PDOException $e) {
       
        $e->getMessage();
    }
}


public static function getGames() {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM products WHERE deleted_at IS NULL ORDER BY id DESC");
    $stmt->execute();
    $games = [];
    
    foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $game) {
        $games[] = new Game(
            $game['name'],
            $game['image_url'], 
            $game['description'],
            $game['price'], 
            $game['stock']
        );
    }
    return $games;
}



public static function renderGameCard($game) {
    return "
    <tr>
        <td>{$game->name}</td>
        <td>{$game->description}</td>
        <td><img src='{$game->image}' alt='Game Image' style='width: 100px; height: auto;'></td>
        <td>{$game->price}</td>
        <td>{$game->stock}</td>
    </tr>";
}

}



?>