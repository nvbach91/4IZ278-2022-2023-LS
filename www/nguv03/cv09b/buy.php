<?php


if (!empty($_GET)) {
    session_start();
    $_SESSION['selected_product_id'] = $_GET['good_id'];
    header('Location: ./profile.php');
}
?>