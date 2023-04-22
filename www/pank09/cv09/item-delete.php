<?php

if (!isset($_GET['id']))
    exit('No product selected.');

require_once __DIR__ . '/classes/ProductsDB.php';

$productsDB = new productsDB();
$product = $productsDB->delete($_GET['id']);

header(sprintf('Location: %s', $_SERVER['HTTP_REFERER'] ?? 'index.php'));
exit();
?>