<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/Cart.php';

$productId = $_POST['product_id'];
$cartId = $_SESSION['cart_id'];

$db = new Database();
$cart = new Cart($db);
$cart->removeFromCart($productId, $cartId);

header('Location: cart.php');
exit();
?>