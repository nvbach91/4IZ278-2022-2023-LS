<?php
require '../models/ProductsDB.php';
require 'authorization.php';
require 'admin-required.php';

$productsDatabase = new ProductsDatabase();

if (!empty($_POST)) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $available = $_POST['available'];
    $img = $_POST['img'];
    $category_id = $_POST['category_id'];

    $productsDatabase->createProduct($name, $price, $description, $img, $available, $category_id);
    // $query = "UPDATE `cv09_goods`  SET name = :name, price = :price, description = :description, img = :img WHERE good_id = :goodId";
    // $statement = $pdo->prepare($query);
    // $statement->execute(['goodId' => $goodId, 'name' => $name, 'price' => $price, 'description' => $description, 'img' => $img]);
}
?>