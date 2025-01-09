<?php
require '../vendor/autoload.php';
use Vendor\GameStore\Productgame;
use Vendor\GameStore\Database;

$error = '';
$success = '';

// loop 3la game li fiha id 
if (isset($_GET['id'])) {
    $gameId = $_GET['id'];
    
    $game = new Productgame();
    $game-> getGameById($gameId);
    if (!$game) {
        $error = "Game not found!";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $gameId = $_POST['id']; // hiden input for id

    if (empty($name) || empty($description) || empty($price) || empty($stock)) {
        $error = "All fields are required!";
    } else {
        $imagePath = $game->image; 
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $imagePath = Productgame::uploadImage($_FILES['image']);
        }

        if (Productgame::updateGame($gameId, $name, $description, $imagePath, $price, $stock)) {
            $success = "Game updated successfully!";
            header('Location: ShowGames.php');
            exit();
        } else {
            $error = "Failed to update the game.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Sidebar and Main Content (same as ADDgames.php) -->
    <div class="main-content">
        <div class="container mt-2">
            <h2 class="text-center mb-4">Edit Game</h2>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form action="editegame.php" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-white">
                <input type="hidden" name="id" value="<?php echo $game->id; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($game->name); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($game->description); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($game->price); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock Quantity</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="<?php echo htmlspecialchars($game->stock); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Update Game</button>
            </form>
        </div>
    </div>
</body>
</html>