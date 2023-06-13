<?php
require '../models/ProductsDB.php';
require 'authorization.php';

$productsDatabase = new ProductsDatabase();

$productId = $_GET['product_id'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = $productsDatabase->fetchById($productId);
if (!$products) {
    exit("Produkt neexistuje");
}

if ($products['available'] === 1) {
    $_SESSION['cart'][] = $products['product_id'];
    header('Location: ../views/cart.php');
} else {
    echo '<script>alert("Produkt není skladem.")</script>';
    header("Refresh:0; url=" . $_SERVER['HTTP_REFERER'], true, 303);
}
