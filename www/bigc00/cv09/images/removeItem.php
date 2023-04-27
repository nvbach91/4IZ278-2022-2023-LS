<?php
session_start();
$id = @$_POST['id'];
foreach ($_SESSION['cart'] as $key => $value){
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
    }
}
header('Location: cart.php');
exit();
?>