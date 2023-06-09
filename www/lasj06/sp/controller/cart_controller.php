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

    #mail
    $to = $_SESSION['user_email'];

    $subject = "DiskShop Order";

    $message =
    '<div>
        <p>Thank you for ordering from DiskShop</p>
        <br>
        <p>We hope to see you again</p>
    </div>';

    $headers = "From: info@diskshop.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    mail($to, $subject, $message, $headers);

    $_SESSION['cart'] = [];
    header('Location: home.php?message=Thank you for your order, we hope to see you again.');
    exit();
}