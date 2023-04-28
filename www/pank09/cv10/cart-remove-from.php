<?php
    require_once "./session.php";

    if (!isset($_GET['id']))
        exit('No product selected.');

    if (!isset($_SESSION['cart']))
        $_SESSION['cart'] = [];

    unset($_SESSION['cart'][$_GET['id']]);

    header('Location: cart.php');
    exit();