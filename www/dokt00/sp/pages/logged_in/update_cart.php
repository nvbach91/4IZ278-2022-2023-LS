<?php
session_start();

require_once '../../db/Database.php';
require_once '../../db/OrderDB.php';
require_once '../../db/OrderitemDB.php';

$orderDB = new OrderDB();
$orderitemDB = new OrderitemDB();

$product_id = $_POST['product_id'];
$new_quantity = $_POST['quantity'];
$user_id = $_SESSION['user_id'];

$order_id = $orderDB->getPendingOrderIDByUserId($user_id);
$orderitem = $orderitemDB->getByOrderAndProductId($order_id, $product_id);

if ($orderitem) {
    $orderitemDB->update($orderitem['orderitem_id'], $new_quantity);
}

$totalPrice = $orderDB->getTotalPriceByUserId($user_id);

echo json_encode(['success' => true, 'totalPrice' => $totalPrice]);
?>
