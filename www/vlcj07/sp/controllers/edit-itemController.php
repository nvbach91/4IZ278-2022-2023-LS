<?php
require '../models/ProductsDB.php';
require 'authorization.php';
require 'admin-required.php';

$productsDatabase = new ProductsDatabase();
$product_id = $_GET['product_id'];
$product = $productsDatabase->fetchById($product_id);


// $query = "SELECT * FROM `cv09_goods` WHERE `good_id` = :goodId";
// $statement = $pdo->prepare($query);
// $statement->execute(['goodId' => $_GET['good_id']]);

if(!$product){
    exit(404);
}

if (!empty($_POST)) {
    $goodId = $_GET['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $available = $_POST['available'];
    $img = $_POST['img'];

    $productsDatabase->updateProduct($product_id, $name, $price, $description, $img, $available);
    // $query = "UPDATE `cv09_goods`  SET name = :name, price = :price, description = :description, img = :img WHERE good_id = :goodId";
    // $statement = $pdo->prepare($query);
    // $statement->execute(['goodId' => $goodId, 'name' => $name, 'price' => $price, 'description' => $description, 'img' => $img]);
}
?>