<?php
require '../model/products.php';
require 'user_required.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = fetchProductById($_GET['product_id']);

@$_SESSION['cart'][] = $products['product_id'];

echo json_encode($_SESSION['cart']);

header('Location: ../view/cart.php');