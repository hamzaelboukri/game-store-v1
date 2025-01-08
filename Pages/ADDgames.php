<?php

require 'vendor/autoload.php';
use Vendor\GameStore\Productgame;
use Vendor\GameStore\game;
use Vendor\GameStore\Database;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    if (isset($_FILES['image'])) {
        $imageFile = $_FILES['image'];
        $imagePath = Game::uploadImage($imageFile);

        if ($imagePath) {
            Game::addGame($name, $description, $imagePath, $price, $stock);
        } else {
            echo "Image upload failed!";
        }
    }
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <h2>Dashboard</h2>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="accounts.php">Accounts</a></li>
            <li><a href="ADDgames.php">Orders</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="support.php">Support</a></li>
        </ul>
    </nav>
</aside>

<!-- Main Content -->
<div class="main-content">
    <div class="container mt-2">
        <h2 class="text-center mb-4">Add a New Product</h2>
        <form action=" " method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-white">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter product description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="image" name="image"  accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="Enter product price" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock Quantity</label>
                <input type="number" class="form-control" id="stock" name="stock" placeholder="Enter stock quantity" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Product</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
