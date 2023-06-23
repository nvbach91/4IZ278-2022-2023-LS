<?php
require_once "cart.php";
require_once "product.php";
require_once "address.php";
require_once "products.php";
require_once "order.php";
require_once "account.php";
if(!isset($_SESSION['cart'])){
$cart = new ShoppingCart();
$_SESSION['cart'] = serialize($cart);
}
if(!isset($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = htmlentities(bin2hex(random_bytes(16)), ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function csrf_check(){
    if(!isset($_REQUEST['csrf_token'])){
        return false;
    }
    if($_REQUEST['csrf_token'] == $_SESSION['csrf_token']){
        return true;
    }
    return false;
}
function verify($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}
?>
