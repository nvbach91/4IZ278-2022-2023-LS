<?php
require './db/db.php';
session_start();

$goodId = $_GET['good_id'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$query = "SELECT * FROM `cv09_goods` WHERE `good_id` = :goodId";
$statement = $pdo->prepare($query);
$statement->execute(['goodId' => $goodId]);
$products = $statement->fetch();
if (!$products) {
    exit("Unable to find goods!");
}

$_SESSION['cart'][] = $products['good_id'];
header('Location: cart.php');
