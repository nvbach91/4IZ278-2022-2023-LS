<?php
require '../models/ProductsDB.php';
require '../models/CategoriesDB.php';
require 'authorization.php';
require 'admin-required.php';

$productsDatabase = new ProductsDatabase();

$categoriesDatabase = new CategoriesDatabase();
$categories = $categoriesDatabase->fetchAll();

if (!empty($_POST)) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $available = $_POST['available'];
    $img = $_POST['img'];
    $category_id = $_POST['category_id'];

    $productsDatabase->createProduct($name, $price, $description, $img, $available, $category_id);
}
