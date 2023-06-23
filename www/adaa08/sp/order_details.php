<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'classes/Database.php';
require_once 'classes/Order.php';

$db = new Database();
$orderObj = new Order($db);

$order = $orderObj->getOrderById($_GET['order_id']);
$orderItems = $orderObj->getOrderItems($_GET['order_id']);

$db->close();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <?php include 'meta.php'; ?>
    <title>Detail Objednávky</title>
</head>
<body>

<?php include 'header.php';?>

<h1 class="center-text">Detail Objednávky <?= htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8') ?></h1>

<table>
    <thead>
        <tr>
            <th>Produkt</th>
            <th>Názov</th>
            <th>Cena</th>
            <th>Množstvo</th>
            <th>Celkom</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orderItems as $item): ?>
        <tr>
            <td><img class="product-image" src="<?= htmlspecialchars($item['photo'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?>"/></td>
            <td><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($item['product_price'], ENT_QUOTES, 'UTF-8') ?>€</td>
            <td><?= htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8') ?> ks</td>
            <td><?= htmlspecialchars($item['quantity'] * $item['product_price'], ENT_QUOTES, 'UTF-8') ?>€</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3 class="center-text">Celková suma: <?= htmlspecialchars($order['total'], ENT_QUOTES, 'UTF-8') ?></h3>

<button onclick="window.history.back()">Späť</button>

<?php include 'footer.php';?>

</body>
</html>
