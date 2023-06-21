<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}


if (!isset($_GET['order_id'])) {
    die('Missing order_id parameter');
}

$order_id = $_GET['order_id'];

require_once 'classes/Database.php';
require_once 'classes/Order.php';
require_once 'classes/Product.php';
require_once 'classes/Admin.php';

$db = new Database();
$orderObj = new Order($db);
$productObj = new Product($db);

$adminObj = new Admin($orderObj, $productObj);


$adminObj->cancelOrder($order_id);


header('Location: admin.php');
?>
