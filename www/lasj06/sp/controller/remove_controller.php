<?php
require 'user_required.php';

$id = $_GET['product_id'];

foreach ($_SESSION['cart'] as $key => $value) {
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
    }
}

header('Location: ../view/cart.php');
exit();