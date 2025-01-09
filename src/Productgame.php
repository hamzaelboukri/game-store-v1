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
            $game['description'],
            $game['image_url'], 
            $game['price'], 
            $game['stock'],
            $game['id']
        );
    }
    return $games;
}



public static function renderGameCard($game) {
    return "
    <tr>
        <td>" . htmlspecialchars($game->name) . "</td>
        <td>" . htmlspecialchars($game->description) . "</td>
        <td>
            <img 
                src='" . htmlspecialchars($game->image) . "' 
                alt='Game Image' 
                style='width: 100px; height: auto;'>
        </td>
        <td>" . htmlspecialchars($game->price) . "</td>
        <td>" . htmlspecialchars($game->stock) . "</td>
    </tr>";
}

public static function updateGame($id, $name, $description, $image, $price, $stock) {
    try {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "UPDATE products 
             SET name = :name, description = :description, image_url = :image, price = :price, stock = :stock 
             WHERE id = :id"
        );
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':description' => $description,
            ':image' => $image,
            ':price' => $price,
            ':stock' => $stock,
        ]);
        
    } catch (\PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}


public static function getGameById($id) {
    try {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM products WHERE id = :id AND deleted_at IS NULL");
        $stmt->execute([':id' => $id]);
        $gameData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($gameData) {
            return new Game(
                $gameData['name'],
                $gameData['description'],
                $gameData['image_url'],
                $gameData['price'],
                $gameData['stock'],
                $gameData['id']
            );
        } else {
            return null;
        }
    } catch (\PDOException $e) {
        error_log($e->getMessage());
        return null;
    }
}



    
    public static function softDeleteGame($id)
    {
        $db = Database::getConnection();
        $query = "UPDATE products SET deleted_at = NOW() WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            ':id'=> $id,
        ]); 
    }
}






?>