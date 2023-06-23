<?php
session_start();
require_once __DIR__ . '/../assets/php/core.php';
$account = new Account();
$privilege = $account->getPrivilege();
if ($privilege < 5) {
    header('Location: ../index.php');
    exit;
}
$orderView = new Order();
$orders = $orderView->GetAllOrders();
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
                <a class="nav-item" href="../account">
                    <p>Uživatelský účet</p>
                </a>
                <a class="nav-item" href="../cart">
                    <p>Nákupní košík</p>
                </a>
            </nav>
        </header>
        <main>
            <h1>Správa objednávek</h1>
            <h2>Správa objednávek</h2>
            <a class="link-button" href="index.php">Zpět</a>
            <?php
            foreach ($orders as $order):
            ?>
            <h3>Objednávka id <?php echo $order['order_id'];?></h3>
            <p>Čas poslední změny: <?php echo $order['date'];?></p>
            <p>Stav objednávky: <?php echo $order['status'];?></p>
            <p>Hodnota objednávky: <?php echo $order['total_price'];?> Kč</p>
            <a class="link-button" href="orderdetail.php?order_id=<?php echo $order['order_id'];?>">Detaily objednávky</a>
            <?php endforeach; ?>
        </main>
        <footer>
            <p>Staromor, Copyright 2023</p>
        </footer>
    </div>
</body>

</html>