<?php 
require '../models/ProductsDB.php';
require 'authorization.php';
require 'admin-required.php';

// $goodId = $_GET['good_id'];

$productsDatabase = new ProductsDatabase();
$product_id = $_GET['product_id'];
$product = $productsDatabase->fetchById($product_id);

if(!$product){
    exit(404);
}

// $query = "DELETE FROM `cv09_goods` WHERE `good_id` = :goodId";
// $statement = $pdo->prepare($query);
// $statement->execute(['goodId' => $goodId]);

$productsDatabase->deleteProduct($product_id);
// ModifyProductsDisplay
header('Location: ../views/modify-products.php');
exit();
?>