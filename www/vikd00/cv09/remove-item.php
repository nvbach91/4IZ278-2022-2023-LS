<?php

if (!empty($_GET)) {
    session_start();

    if (!empty($_GET['good_id'])) {
        if (isset($_SESSION['cart'])) {
            $good_id = $_GET['good_id'];
            $index = array_search($good_id, $_SESSION['cart']);
            if ($index !== false) {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index the array after removing the item
            }
        }
    }

    header('Location: ./cart.php');
}
