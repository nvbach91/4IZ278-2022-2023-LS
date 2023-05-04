<?php

session_start();
$id = $_POST['product_id'];

foreach ($_SESSION['selected_products'] as $key => $value) {
    if ($value == $id) {
        unset($_SESSION['selected_products'][$key]);
    }
}

header('Location: ./cart.php');

?>