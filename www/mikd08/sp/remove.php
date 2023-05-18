<?php 

if (!empty($_GET['product_id'])) {
    session_start();

    if (isset($_SESSION['cart'])) {
        if (array_key_exists($_GET['product_id'], $_SESSION['cart'])) {
            if ($_SESSION['cart'][$_GET['product_id']]["amount"] > 1) {
                $_SESSION['cart'][$_GET['product_id']]["amount"] -= 1;
            } else {
                unset($_SESSION['cart'][$_GET['product_id']]);
            }
        }
    }
}
header('Location: cart.php');

?>