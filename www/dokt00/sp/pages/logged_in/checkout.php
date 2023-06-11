<?php
session_start();

require_once '../../db/Database.php';
require_once '../../db/OrderDB.php';
require_once '../../db/OrderitemDB.php';
require_once '../../db/ProductDB.php';

$orderDB = new OrderDB();
$orderitemDB = new OrderitemDB();
$productDB = new ProductDB();

$user_id = $_SESSION['user_id'];
$order_id = $orderDB->getPendingOrderIDByUserId($user_id);

$order_items = $orderitemDB->getAllByOrderId($order_id);

if (empty($order_items)) {
    echo "Your cart is empty.";
    exit;
}

foreach ($order_items as $item) {
    $productDB->decrementStock($item['product_id'], $item['quantity']);
}

$orderDB->markAsCompleted($order_id);

echo "Checkout successful.";
?>
