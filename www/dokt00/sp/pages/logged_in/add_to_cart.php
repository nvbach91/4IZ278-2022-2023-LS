<?php
session_start();

require_once '../../db/Database.php';
require_once '../../db/OrderDB.php';
require_once '../../db/OrderitemDB.php';

$orderDB = new OrderDB();
$orderitemDB = new OrderitemDB();

$product_id = $_POST['product_id'];
$user_id = $_SESSION['user_id'];

$order_id = $orderDB->getPendingOrderIDByUserId($user_id);
if ($order_id) {
    $orderitem = $orderitemDB->getByOrderAndProductId($order_id, $product_id);
    if ($orderitem) {
        $orderitemDB->increaseQuantity($orderitem['orderitem_id']);
    } else {
        $orderitemDB->create($order_id, $product_id);
    }
} else {
    $orderDB->createPending($user_id);
    $order_id = $orderDB->getPendingOrderIDByUserId($user_id);
    $orderitemDB->create($order_id, $product_id);
}

echo json_encode([
    'success' => true,
    'message' => 'Item added to cart'
]);
