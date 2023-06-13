<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare(
    "SELECT 
        orders.order_id, 
        orders.order_date,
        products.product_name,
        order_items.quantity,
        products.price
    FROM orders 
    INNER JOIN order_items ON orders.order_id = order_items.order_id
    INNER JOIN products ON order_items.product_id = products.product_id
    WHERE orders.user_id = ? 
    ORDER BY orders.order_date DESC"
);
$stmt->execute([$user_id]);

$orders = $stmt->fetchAll(PDO::FETCH_GROUP);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order History</title>
    <link rel="stylesheet" href="styles/history_style.css">
  
</head>
<body>
<div class="container">
    <a class="back-button" href="index.php">Back to homepage</a>

    <h1>Order History</h1>

    <?php
    foreach ($orders as $orderId => $orderItems) {
        $totalAmount = 0;
        echo '<div class="order">';
        echo '<h3>Order id: ' . $orderId . '</h3>';
        echo '<p>Date: ' . date("Y-m-d H:i:s", $orderItems[0]['order_date']) . '</p>';

        foreach ($orderItems as $order) {
            echo '<div class="order-item">';
            echo '<p>Product: ' . $order['product_name'] . '</p>';
            echo '<p>Quantity: ' . $order['quantity'] . '</p>';
            echo '</div>';

            $totalAmount += $order['price'] * $order['quantity'];
        }

        echo '<p>Total amount: $' . number_format($totalAmount, 2) . '</p>';
        echo '</div>';
    }
    ?>
</div>
</body>
</html>

