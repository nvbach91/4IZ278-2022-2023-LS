<?php
require_once "cart.php";
require_once "product.php";
require_once "address.php";
if(!isset($_SESSION['cart'])){
$cart = new ShoppingCart();
$_SESSION['cart'] = serialize($cart);
}

function verify($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
