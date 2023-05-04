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

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}
$itemsPerPage = 4;   

$count = $productDatabase -> query("SELECT COUNT(`product_id`) AS COUNT FROM products", [])[0]['COUNT'];
$stmt = $productDatabase -> pdo -> prepare("SELECT * FROM products ORDER BY product_id ASC LIMIT $itemsPerPage OFFSET ?");
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll();
require('./src/header.php');
require('./src/body.php');
?>