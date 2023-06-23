<?php
require_once ('./db/ProductDatabase.php');
$productAdd = new ProductDatabase();
if(!isset($_SESSION)){
    session_start();
}
if (isset($_POST['product_id'])) {
    $current_added_item = $productAdd->fetchById($_POST['product_id']);
    $_SESSION['cart_list'][] = $current_added_item;
    echo count($_SESSION['cart_list']);
} else {
    $current_added_item = $productAdd->fetchById($_POST['product_id']);
    $_SESSION['cart_list'][] = $current_added_item;
    echo count($_SESSION['cart_list']);
}