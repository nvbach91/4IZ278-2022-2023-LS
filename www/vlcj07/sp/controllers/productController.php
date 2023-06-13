<?php

require '../models/ProductsDB.php';

$productId = $_GET['product_id'];

$productsDatabase = new ProductsDatabase();

$product = $productsDatabase->fetchById($productId);
