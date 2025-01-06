<?php
require 'vendor/autoload.php';
use Vendor\GameStore\Account;
if (Account::handleStatusUpdate()) {
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$accounts = Account::getAccounts();
// var_dump ($accounts);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Dashboard</h2>
            <nav>
                <ul>
                <li><a href="#settings">Home</a></li>
                    <li><a href="#overview">les account</a></li>
                    <li><a href="#analytics">les order</a></li>
                    <li><a href="#settings">Settings</a></li>
                    <li><a href="#support">Support</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->

            <main class="main-content">
            <header class="header">
                <h1>Account Management</h1>
            </header>
            
            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accounts as $account):?>
                        <?php echo $account->renderRow(); ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
            
        </main>
    </div>
</body>
</html>
