<!-- oprávnění pro 1+ -->

<?php
require '../models/ProductsDB.php';
require 'authorization.php';

$productsDatabase = new ProductsDatabase();

$productId = $_GET['product_id'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// $query = "SELECT * FROM `sp_products` WHERE `product_id` = :productId";
// $statement = $pdo->prepare($query);
// $statement->execute(['productId' => $productId]);
// $products = $statement->fetch();
$products = $productsDatabase->fetchById($productId);
if (!$products) {
    exit("Unable to find goods!");
}

$_SESSION['cart'][] = $products['product_id'];
header('Location: ../views/cart.php');
