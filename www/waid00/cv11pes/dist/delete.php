<?php
session_start();
include('database.php');
if(!isset($_SESSION['login']) && $_SESSION['privilege'] == 0){
    header('Location: login.php');
}


$stmt = $pdo->prepare("DELETE FROM orders WHERE `orders`.`product_id` = ?");
$stmt->execute([$_GET['id']]);
$stmt = $pdo->prepare("DELETE FROM products WHERE `products`.`product_id` = ?");
$stmt->execute([$_GET['id']]);
header('Location: index.php');
