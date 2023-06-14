<?php
session_start();
require_once 'auth.php';
requireLogin();

if (!empty($_GET['good_id'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (!in_array($_GET['good_id'], $_SESSION['cart'])) {
        $_SESSION['cart'][] = $_GET['good_id'];
    }
}

header('Location: ./cart.php');
exit;
?>
