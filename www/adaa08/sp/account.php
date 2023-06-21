<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Order.php';

$db = new Database();
$userObj = new User($db);
$orderObj = new Order($db);

$user = $userObj->getUser($_SESSION['user_id']);
$orders = $orderObj->getOrdersByUserId($_SESSION['user_id']);

$db->close();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <?php include 'meta.php'; ?>
    <title>Môj Účet</title>
</head>
<body>

<?php include 'header.php';?>

<h1 class="center-text">Vitajte, <?= htmlspecialchars($user['first_name'], ENT_QUOTES, 'UTF-8') ?></h1>
<h3 class="center-text">Objednávky v priebehu spracovania</h3>
<div class="grid-container">


    
    <?php foreach ($orders as $order): ?>
        <?php if($order['status'] == 'Spracováva sa'): ?>
            <div class="order-item">
                <h4>Objednávka<?= htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8') ?></h4>
                <p>Suma: <?= htmlspecialchars($order['total'], ENT_QUOTES, 'UTF-8') ?></p>
                <p>Status: <?= htmlspecialchars($order['status'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
        </div>
        <h3 class="center-text">Hotové objednávky</h3>
        <div class="grid-container">
    
    <?php foreach ($orders as $order): ?>
        <?php if($order['status'] == 'Vybavená'): ?>
            <div class="order-item">
                <h4>Objednávka<?= htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8') ?></h4>
                <p>Suma: <?= htmlspecialchars($order['total'], ENT_QUOTES, 'UTF-8') ?></p>
                <p>Status: <?= htmlspecialchars($order['status'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

    <a href="logout.php" class="logout-button" >Odhlásiť sa
    </a>

<?php include 'footer.php';?>

</body>
</html>