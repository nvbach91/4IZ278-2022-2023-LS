<?php
session_start();
require_once 'config.php';

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]--;

        if ($_SESSION['cart'][$productId] === 0) {
            unset($_SESSION['cart'][$productId]);
        }
    }
}

header('Location: cart.php');
exit();
?>