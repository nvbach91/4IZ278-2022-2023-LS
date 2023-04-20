<?php
session_start();
require('./db/ProductsDB.php');
$productDatabase = new ProductsDB();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$sql = "SELECT * FROM products WHERE product_id = :product_id";
$stmt = $productDatabase->pdo->prepare($sql);
$stmt->execute(['product_id' => $_GET['id']]);
$products = $stmt->fetch();
if (!$products){
    exit("Unable to find goods!");
}
$_SESSION['cart'][] = $products["product_id"];
header('Location: cart.php');
exit();
?>