<?php
require_once('./db/ProductsDB.php');
$productID = $_GET['productID'];
$db = new ProductsDB();
$pdo = $db -> pdo;
$statement = $pdo -> prepare("DELETE FROM `products` WHERE `product_id` = :productID");
$statement -> execute([
    'productID' => $productID
]);
header('Location: index.php');
exit();
?>