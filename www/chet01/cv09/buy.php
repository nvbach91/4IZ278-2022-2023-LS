<?php
session_start();
if (isset($_GET['product_id'])) {
    $productid = $_GET['product_id'];
    $exists = true;

    if ($exists) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [$productid];
        } else {
            array_push($_SESSION['cart'], $productid);
        }
        header('Location: ./index.php');
    }
}
