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
            $cart[$goodId]++;
        } else {
            $cart[$goodId] = 1;
        }
    } elseif ($action === 'decrement') {
        if (isset($cart[$goodId])) {
            $cart[$goodId]--;
            if ($cart[$goodId] <= 0) {
                unset($cart[$goodId]);
            }
        }
    }

    $_SESSION['cart'] = $cart;
}

header('Location: ./cart.php');
exit();
?>
