<?php
require '../vendor/autoload.php';
use Vendor\GameStore\Productgame;

$games = Productgame::getGames();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Games</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Dashboard</h2>
            <nav>
                <ul>
                    <li><a href="../admin_page.php">Accounts</a></li>
                    <li><a href="./ADDgames.php">Add Games</a></li>
                    <li><a href="./ShowGames.php">Show Games</a></li>
                    <li><a href="#support">Support</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <h1>Games Management</h1>
            </header>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($games as $game): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($game->name); ?></td>
                                <td><?php echo htmlspecialchars($game->description); ?></td>
                                <td>
                                    <?php if ($game->image): ?>
                                        <img src="<?php echo htmlspecialchars($game->image); ?>" alt="Game Image" width="100">
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($game->price); ?></td>
                                <td><?php echo htmlspecialchars($game->stock); ?></td>
                                <td>
                                   
                                    <a href="../modifer/editegame.php?id=<?php echo $game->id; ?>" class="btn btn-primary btn-sm">Edit</a>
                                  
                                    <form action="../delete/deletegame.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $game->id; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this game?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>