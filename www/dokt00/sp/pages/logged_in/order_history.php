<?php
session_start();

require_once '../../db/Database.php';
require_once '../../db/OrderDB.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

$orderDB = new OrderDB();
$orders = $orderDB->getOrdersByUserId($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Order History</h1>

    <table>
        <tr>
            <th>Order ID</th>
            <th>Date</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>

        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['order_id'] ?></td>
                <td><?= $order['date'] ?></td>
                <td><?= $order['name'] ?></td>
                <td><?= $order['quantity'] ?></td>
                <td><?= $order['total_price'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
