<?php

if (!isset($_GET['id']))
    exit('No product selected.');

session_start();

if (!isset($_SESSION['cart']))
    $_SESSION['cart'] = [];

require_once __DIR__ . '/classes/ProductsDB.php';

$productsDB = new productsDB();
$product = $productsDB->fetch($_GET['id']);

if (!$product)
    exit('No product found.');

if (isset($_SESSION['cart'][$product['good_id']])) {
	$_SESSION['cart'][$product['good_id']] += 1;
} else {
	$_SESSION['cart'][$product['good_id']] = 1;
}

header('Location: cart.php');
exit();
?>