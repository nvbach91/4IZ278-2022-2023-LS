<?php
session_start();
require 'db/Database.php';
$db = new Database();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$sql = "SELECT * FROM cv06_products WHERE product_id = :id";
$stmt = $db->pdo->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
$goods = $stmt->fetch();
if (!$goods){
    exit("Unable to find goods!");
}
$_SESSION['cart'][] = $goods["product_id"];
header('Location: cart.php');
exit();
?>