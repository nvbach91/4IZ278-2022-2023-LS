<?php

require_once '../../db/Database.php';
require_once '../../db/ProductDB.php';

$productDB = new ProductDB();

if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['stock']) && isset($_POST['image_url'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image_url = $_POST['image_url'];
    $category_id = $_POST['category_id'];

    $productDB->insertProduct($name, $description, $price, $stock, $image_url, $category_id);
}

?>
