<?php
require '../model/products.php';

$products = fetchAllProducts();
$count = count($products);

$allCategories = fetchAllCategories();
