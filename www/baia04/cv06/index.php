<?php

require('./db/ProductsDB.php');
require('./db/CategoriesDB.php');
require('./db/DiscountsDB.php');

$categoryDatabase = new CategoriesDB();
$categories = $categoryDatabase -> fetchAll();

$productDatabase = new ProductsDB();
if (isset($_GET['category_id'])) {
    $products = $productDatabase -> fetchByCategory($_GET['category_id']);
} else {
    $products = $productDatabase -> fetchAll();
}

$discountsDB = new DiscountsDB();
$discountedProductIDs = $discountsDB -> fetchAll();
$discountedProducts = [];
foreach ($discountedProductIDs as $discountedProductID) {
    $id = $discountedProductID['product_id'];
    $discountedProducts[$id] = $productDatabase -> fetchByID($id);
}

require('./src/header.php');
require('./src/body.php');
?>