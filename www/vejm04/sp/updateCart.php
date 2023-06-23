<?php
session_start();
require_once 'config.php';

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    if (isset($_POST['increase_quantity'])) {
        $_SESSION['cart'][$productId]++;
    } elseif (isset($_POST['decrease_quantity'])) {
        if ($_SESSION['cart'][$productId] > 1) {
            $_SESSION['cart'][$productId]--;
        } else {
            unset($_SESSION['cart'][$productId]);
        }
    }
}

header('Location: cart.php');
exit();
?>
