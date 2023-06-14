<?php
session_start();
if (isset($_GET['product_id'])) {
    $quantity = (int)$_GET['quantity'];
    $product_id = $_GET['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {

        $_SESSION['cart'][$product_id] = array('quantity' => $quantity + 1);
    } else {
        $_SESSION['cart'][$product_id] = array('quantity' => $quantity);
    }
    header("Location: one_product.php?product=$product_id");
}
