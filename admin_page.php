<?php
require 'vendor/autoload.php';
use Vendor\GameStore\Account;
if (isset($_POST['id']) && isset($_POST['status'])) {
    Account::updateStatus($_POST['id'], $_POST['status']);
    header('Location: admin_page.php');
    exit();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <li><a href="./Pages/ADDgames.php"> AddGames</a></li>
                    <li><a href="./Pages/ShowGames.php">showgames</a></li>
                    <li><a href="#support">Support</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->

            <main class="main-content">
            <header class="header">
                <h1>Account Management</h1>
            </header>
             <div>
            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                        <th>action</th>

                      
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accounts as $account):?>
                        <?php echo $account->renderRow(); ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </main>
    </div>
            
        </main>
    </div>
</body>
</html>
