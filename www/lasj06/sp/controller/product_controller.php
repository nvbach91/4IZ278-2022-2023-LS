<?php
require_once '../model/products.php';

$product = fetchProductById($_GET['product_id']);

if ($product == null) {
    $product['name'] = "Incorrect product Id";
}
