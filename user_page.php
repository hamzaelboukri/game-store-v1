<?php
require '../vendor/autoload.php';
use Vendor\GameStore\Productgame;
use Vendor\GameStore\Database;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store - User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
  
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-controller"></i> Game Store
            </a>
            
            <!-- Search Box -->
            <form class="d-flex mx-auto search-box">
                <input class="form-control me-2" type="search" placeholder="Search games..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            
            <div class="d-flex align-items-center">
                <!-- Cart Icon -->
                <a href="#" class="btn btn-outline-light me-3 cart-icon">
                    <i class="bi bi-cart3"></i>
                    <span class="cart-count">0</span>
                </a>
                
                <!-- User Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-clock-history"></i> Order History</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <!-- Sidebar Filters -->
                <div class="col-lg-3 mb-4">
                    <div class="filters">
                        <h5 class="mb-3">Filters</h5>
                        
                        <!-- Price Range -->
                        <div class="mb-4">
                            <label class="form-label">Price Range</label>
                            <div class="price-range">
                                <input type="range" class="form-range" min="0" max="100" id="priceRange">
                                <div class="d-flex justify-content-between">
                                    <span>$0</span>
                                    <span>$100</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Categories -->
                        <div class="mb-4">
                            <label class="form-label">Categories</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="action">
                                <label class="form-check-label" for="action">Action</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="adventure">
                                <label class="form-check-label" for="adventure">Adventure</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rpg">
                                <label class="form-check-label" for="rpg">RPG</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="simulation">
                                <label class="form-check-label" for="simulation">Simulation</label>
                            </div>
                        </div>
                        
                        <!-- Apply Filters Button -->
                        <button class="btn btn-primary w-100">Apply Filters</button>
                    </div>
                </div>
                
                <!-- Games Grid -->
                <div class="col-lg-9">
                    <!-- Sort Options -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="m-0">Available Games</h4>
                        <select class="form-select sort-dropdown">
                            <option selected>Sort by: Featured</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest First</option>
                        </select>
                    </div>
                    
                    <!-- Games Display -->
                    <?php echo $productGame->displayer(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Game Store</h5>
                    <p>Your one-stop destination for digital games.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">Terms of Service</a></li>
                        <li><a href="#" class="text-light">Privacy Policy</a></li>
                        <li><a href="#" class="text-light">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Connect With Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Shopping Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Cart items will be dynamically loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue Shopping</button>
                    <button type="button" class="btn btn-primary">Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
     
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const gameId = this.dataset.gameId;
             
                updateCartCount();
            });
        });

        function updateCartCount() {
            const cartCount = document.querySelector('.cart-count');
            
        }
    </script>
</body>
</html>