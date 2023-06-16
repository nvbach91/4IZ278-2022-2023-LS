<?php
require 'authorization.php';
require 'admin-required.php';
require '../models/OrdersDB.php';
require '../models/ProductsDB.php';
require '../models/OrderItemsDB.php';

$ordersDatabase = new OrdersDatabase();
$orderItemsDatabase = new OrderItemsDatabase();
$productsDatabase = new ProductsDatabase();

$order_id = $_GET['order_id'];

$orders = $ordersDatabase->fetchByOrderId($order_id);

$order = $orderItemsDatabase->fetchAllByOrderId($order_id);
$items = [];

foreach ($order as $item) {
    $amount = $item['amount'];
    $price = $item['price'];
    $product_id = $item['product_id'];

    $product = $productsDatabase->fetchById($product_id);

    $items[] = [
        'amount' => $amount,
        'price' => $price,
        'product_id' => $product_id,
        'product_name' => $product['name'],
    ];
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $order_id = $orders['order_id'];
    $status = $_POST['status'];
    $total_price = $orders['total_price'];
    $date = $orders['date'];
    $user_id = $orders['user_id'];

    $ordersDatabase->updateOrder($order_id, $status, $date, $user_id, $total_price);
    header("Location: orders-all.php");
    exit();
}
