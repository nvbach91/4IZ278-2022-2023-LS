<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}


if (!isset($_GET['product_id'])) {
    die('Chýba parameter');
}

$product_id = $_GET['product_id'];

require_once 'classes/Database.php';
require_once 'classes/Product.php';

$db = new Database();
$product = new Product($db);


$product->deleteProduct($product_id);


header('Location: admin.php');
?>