<?php
session_start();
require_once __DIR__ . '/../assets/php/core.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
if (isset($_SESSION['gtoken'])) {
    require_once(__DIR__ . '/../assets/config/google.php');
    $client->setAccessToken($_SESSION['gtoken']);
    if ($client->isAccessTokenExpired()) {
        header('Location: logout.php');
        exit;
    }
}
$account = new Account();
$privilege = $account->getPrivilege();
?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Staromor</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css">
    <link rel="stylesheet" media="print" href="../assets/css/print.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Obchod, Starožitnosti, Starožitnost, sklo, porcelán, kvalitní">
    <meta name="description" content="Obchod se starožitnosti">
    <meta name="author" content="Jakub Starosta">
</head>

<body>
    <div class="wrapper">
        <header>
            <nav class="nav-list">
                <a class="nav-item" href="../">
                    <p>Staromor</p>
                </a>
                <a class="nav-item" href="../store">
                    <p>Obchod</p>
                </a>
                <a class="nav-item-current" href="../account">
                    <p>Uživatelský účet</p>
                </a>
                <a class="nav-item" href="../cart">
                    <p>Nákupní košík</p>
                </a>
            </nav>
        </header>
        <main>
            <h1>Účet</h1>
            
            <?php if (isset($_SESSION['user_id'])): ?>
            <h2>Účet</h2>
            <ul>
                <li>Uživatelské jméno: <?php echo $_SESSION['username']; ?></li>
                <li>Email: <?php echo $_SESSION['email']; ?></li>
            </ul>
            <a class="link-button" href="logout.php">Odhlásit se</a>
            <a class="link-button" href="useraddress.php">Moje adresy</a>
            <a class="link-button" href="userorders.php">Moje objednávky</a>
            <?php if($privilege >= 5): ?>
            <a class="link-button" href="../administration/">Administrace</a>
            <?php endif; ?>

            <?php endif; ?>
        </main>
        <footer>
            <p>Staromor, Copyright 2023</p>
        </footer>
    </div>
</body>

</html>