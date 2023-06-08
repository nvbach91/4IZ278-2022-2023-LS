<?php
require '../model/cart.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$ids = @$_SESSION['cart'];
$products = [];
$sum = 0;

if (is_array($ids) && count($ids)) {
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';    

    $products = fetchProductsByCart($ids, $question_marks);
    $sum = fetchSumByCart($ids, $question_marks);
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    insertOrder($_POST['address'], $_SESSION['user_email']);

    $question_marks = str_repeat('?,', count($ids) - 1) . '?';    
    $products = fetchProductsByCart($ids, $question_marks);

    insertOrderItems($products);

    mail($_SESSION['user_email'], "DiskShop Order", "Thank you for shopping at DiskShop",'From: info@diskshop.com');

    $_SESSION['cart'] = [];
    header('Location: home.php');
    exit();
}