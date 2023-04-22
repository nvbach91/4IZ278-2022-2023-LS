<?php

require_once __DIR__ . '/../../classes/ProductsDB.php';

use classes\ProductsDB;

$htmlTitle = 'HW Shop | Products | Delete';
if (!isLoggedIn()) header('Location: home');

$productsDB = new ProductsDB();
$productsDB->deleteProduct(intval($_GET['id']));

Header("Location: products");
exit();