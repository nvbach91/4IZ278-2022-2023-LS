<?php
session_start();

// Ensure the user is an admin
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Check if order_id is set
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

// Cancel the order
$adminObj->cancelOrder($order_id);

// Redirect back to admin page
header('Location: admin.php');
?>
