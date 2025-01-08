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
        echo "Produit ajouté avec succès dans la base de données !";
    } catch (\PDOException $e) {
       
        echo "Erreur lors de l'ajout du produit : " . $e->getMessage();
    }
}

private function getAllGames(): array {
    $stmt = $this->db->query("SELECT * FROM products WHERE deleted_at IS NULL ORDER BY id DESC");
    $games = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $games[] = Game::fromDatabaseRow($row);
    }
    return $games;
}

private function renderGames(array $games): string {
    $output = '<div class="games-container">';
    
    foreach ($games as $game) {
        $output .= $this->renderGameCard($game);
    }
    
    return $output . '</div>';
}

private function renderGameCard(Game $game): string {
    return sprintf(
        '<div class="game-card">
            <img src="%s" alt="%s" class="game-image">
            <div class="game-details">
                <h3>%s</h3>
                <p>%s</p>
                <div class="game-meta">
                    <span class="price">$%.2f</span>
                    <span class="stock">Stock: %d</span>
                    <button class="btn btn-primary add-to-cart" data-game-id="%d">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>',
        htmlspecialchars($game->getImageUrl()),
        htmlspecialchars($game->getName()),
        htmlspecialchars($game->getName()),
        htmlspecialchars($game->getDescription()),
        $game->getPrice(),
        $game->getStock(),
        $game->getId()
    );
}



}
?>