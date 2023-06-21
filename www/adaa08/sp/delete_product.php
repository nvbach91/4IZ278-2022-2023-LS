<?php
session_start();

// Ensure the user is an admin
if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Check if product_id is set
if (!isset($_GET['product_id'])) {
    die('Chýba parameter');
}

$product_id = $_GET['product_id'];

require_once 'classes/Database.php';
require_once 'classes/Product.php';

$db = new Database();
$product = new Product($db);

// Mark the product as deleted
$product->deleteProduct($product_id);

// Redirect back to admin page
header('Location: admin.php');
?>