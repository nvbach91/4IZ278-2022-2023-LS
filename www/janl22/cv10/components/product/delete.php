<?php

require_once __DIR__ . '/../../classes/ProductsDB.php';

use classes\ProductsDB;

$htmlTitle = 'HW Shop | Products | Delete';
if (!hasPermission('store.manager')) {
	require_once __DIR__ . '/../../templates/403.php';
	exit();
}

$ProductsDB = new ProductsDB();
$ProductsDB->deleteProduct(intval($_GET['id']));

Header("Location: products");
exit();