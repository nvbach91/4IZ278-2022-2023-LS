<?php
require '../models/ProductsDB.php';
require 'authorization.php';

if (isset($_SESSION['cart'])) {
    $productId = $_GET['product_id'];
    $id = array_search($productId, $_SESSION['cart']);
    if ($id !== false) {
        unset($_SESSION['cart'][$id]);
    }
}

header('Location: ../views/cart.php');
