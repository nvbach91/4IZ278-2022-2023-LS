<?php 
require '../models/ProductsDB.php';
require 'authorization.php';
require 'admin-required.php';

$productsDatabase = new ProductsDatabase();
$product_id = $_GET['product_id'];
$product = $productsDatabase->fetchById($product_id);

if(!$product){
    exit(404);
}

$productsDatabase->deleteProduct($product_id);
header('Location: ../views/modify-products.php');
exit();
