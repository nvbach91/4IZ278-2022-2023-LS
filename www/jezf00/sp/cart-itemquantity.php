<?php
session_start();
require_once 'auth.php';
requireLogin();

if (!empty($_GET['good_id']) && !empty($_GET['action'])) {
    $goodId = $_GET['good_id'];
    $action = $_GET['action'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $cart = $_SESSION['cart'];

    if ($action === 'increment') {
        if (isset($cart[$goodId])) {
            $quantity = $cart[$goodId]+1;
            if ($quantity <= 10) {
                $cart[$goodId] = $quantity; 
            }
        } else {
            $cart[$goodId] = 1; 
        }
    } elseif ($action === 'decrement') {
        if (isset($cart[$goodId])) {
            $quantity = $cart[$goodId] - 1;
            if ($quantity > 0) {
                $cart[$goodId] = $quantity; 
            } else {
                unset($cart[$goodId]); 
            }
        }
    }

    $_SESSION['cart'] = $cart;
}

header('Location: ./user/cart.php');
exit();
?>
