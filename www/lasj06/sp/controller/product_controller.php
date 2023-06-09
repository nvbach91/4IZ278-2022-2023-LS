<?php
require_once '../model/products.php';


@$product = fetchProductById($_GET['product_id']);

if ($product == null) {
    $product['name'] = "Incorrect product Id";
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if (array_key_exists('search', $_POST)) {
        ;
    } elseif (array_key_exists('new_name', $_POST)) {
        $newProductId = insertProduct();
        header("Location: product.php?product_id=" . $newProductId);
    } else {
        updateProduct($product['product_id']);
        header("Location: product.php?product_id=" . $product['product_id']);
    }
}