<?php

require_once __DIR__ . '/../../classes/ProductsDB.php';

use classes\ProductsDB;

$ProductsDB = new ProductsDB();
$product = $ProductsDB->fetchById($_GET['id']);

if (empty($product)) {
	require_once __DIR__ . '/../../templates/400.php';
	exit();
}

if (isset($_SESSION['cart'][$product['id_product']])) {

	$_SESSION['cart'][$product['id_product']]['count'] += 1;

} else {

	$_SESSION['cart'][$product['id_product']] = [
		'id_product' => $product['id_product'],
		'name' => $product['name'],
		'count' => 1,
		'unitPrice' => $product['price']
	];
}

if ($_GET['flag'] == 'buy') {
	Header("Location: cart");
} else {
	Header("Location: home");
}

exit();