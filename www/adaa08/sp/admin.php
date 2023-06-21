<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/Order.php';
require_once 'classes/Product.php';
require_once 'classes/Admin.php';

$db = new Database();
$orderObj = new Order($db);
$productObj = new Product($db);
$adminObj = new Admin($orderObj, $productObj);

$current_orders = $adminObj->getCurrentOrders();
$completed_orders = $adminObj->getCompletedOrders();
$products = $adminObj->getAllProducts();

$db->close();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Admin</title>
    <?php include 'meta.php'; ?>
</head>
<body>

<?php include 'header.php';?>

    <h1>Vitajte, Admin</h1>

    <nav>
        <ul>
            <li><a href="#current-orders">Aktúalne objednávky</a></li>
            <li><a href="#completed-orders">História objednávok</a></li>
            <li><a href="#products">Produkty</a></li>
        </ul>
    </nav>

    <section id="current-orders">
        <h2>Aktuálne objednávky</h2>
        <?php foreach ($current_orders as $order): ?>
        <div>
            <h3>Objednávka <?= htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p>Suma: <?= htmlspecialchars($order['total'], ENT_QUOTES, 'UTF-8') ?></p>
            <p>Status: <?= $order['status'] ?></p>
            <button type="button" onclick="location.href='mark_as_completed.php?order_id=<?= $order['order_id'] ?>'">Vybaviť</button>
            <a href="cancel_order.php?order_id=<?= $order['order_id'] ?>">Zrušiť</a>
        </div>
        <?php endforeach; ?>
    </section>



    <section id="completed-orders">
        <h2>História objednávok</h2>
        <?php foreach ($completed_orders as $order): ?>
        <div>
            <h3>Objednávka <?= htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p>Suma: <?= htmlspecialchars($order['total'], ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <?php endforeach; ?>
    </section>

    <section id="products">
        <h2>Všetky produkty</h2>
        <?php foreach ($products as $product): ?>
        <div>
            <h3><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p>Cena: <?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8') ?></p>
            <button type="button" onclick="location.href='edit_product.php?product_id=<?= $product['product_id'] ?>'">Upraviť</button>
            <button type="button" onclick="location.href='delete_product.php?product_id=<?= $product['product_id'] ?>'">Vymazať</button>
        </div>
        <?php endforeach; ?>
    </section>

    <a href="logout.php">Odhlásiť sa</a>

    <?php include 'footer.php';?>
</body>
</html>