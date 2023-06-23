<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/Order.php';
require_once 'classes/Product.php';
require_once 'classes/User.php';
require_once 'classes/Admin.php';

$db = new Database();
$orderObj = new Order($db);
$productObj = new Product($db);
$userObj = new User($db);
$adminObj = new Admin($orderObj, $productObj, $userObj);

$current_orders = $adminObj->getCurrentOrders();
$completed_orders = $adminObj->getCompletedOrders();
$products = $adminObj->getAllProducts();
$users = $adminObj->getAllUsers();

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

<div class="container">
    <aside>
        <nav>
            <ul>
                <li><a href="#current-orders"  style="color:#333">Aktúalne objednávky</a></li>
                <li><a href="#completed-orders" style="color:#333">História objednávok</a></li>
                <li><a href="#products" style="color:#333">Produkty</a></li>
                <li><a href="#users" style="color:#333">Používatelia</a></li>
            </ul>
        </nav>
    </aside>

    <main>
    <h1 class="center-text">Vitajte, Admin</h1>
    <h2 class="center-text">Aktúalne objednávky</h2>

    <div class="grid-container">
        <?php foreach ($current_orders as $order): ?>
        <div class="order-item">
            <h4><a href="order_details.php?order_id=<?= htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8') ?>">Objednávka <?= htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8') ?></a></h4>
            <p>Suma: <?= htmlspecialchars($order['total'], ENT_QUOTES, 'UTF-8') ?></p>
            <p>Status: <?= $order['status'] ?></p>
            <button type="button" onclick="location.href='mark_as_completed.php?order_id=<?= $order['order_id'] ?>'">Vybaviť</button>
            <a href="cancel_order.php?order_id=<?= $order['order_id'] ?>">Zrušiť</a>
        </div>
        <?php endforeach; ?>
    </div>

    <h2 class="center-text">Vybavené objednávky</h2> 

    <div class="grid-container">
        <?php foreach ($completed_orders as $order): ?>
        <div class="order-item">
            <h4><a href="order_details.php?order_id=<?= htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8') ?>">Objednávka <?= htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8') ?></a></h4>
            <p>Suma: <?= htmlspecialchars($order['total'], ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <?php endforeach; ?>
    </div>

        <section id="products">
            <h2>Všetky produkty</h2>
            <div class="product-grid">
                <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <img src="<?= htmlspecialchars($product['photo'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>">
                    <h3><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p>Cena: <?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8') ?></p>
                    <button type="button" onclick="location.href='edit_product.php?product_id=<?= $product['product_id'] ?>'">Upraviť</button>
                    <button type="button" onclick="location.href='delete_product.php?product_id=<?= $product['product_id'] ?>'">Vymazať</button>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

    <section>
        <h2>Pridať nový produkt</h2>
    <button type="button" onclick="location.href='add_product.php'">Pridať nový produkt</button>
    </section>

    <section id="users">
    <h2>Používatelia</h2>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Rola</th>
                <th>Úprava</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <a href="change_role.php?email=<?= urlencode($user['email']) ?>">Zmeniť rolu</a> | 
                    <a href="delete_user.php?email=<?= urlencode($user['email']) ?>">Odstrániť</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </section>

        <a href="logout.php" class="logout-button">Odhlásiť sa</a>
    </main>
</div>

<?php include 'footer.php';?>
</body>
</html>