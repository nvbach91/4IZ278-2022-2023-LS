<?php 

if(!empty($_GET)){
    session_start();
    if (!isset($_SESSION['selected_product'])) {
        $_SESSION['selected_product'] = array();
        $_SESSION['product_quantity'] = array();
    }
    array_push($_SESSION['selected_product'],$_GET['product_id']);
    array_push($_SESSION['product_quantity'],'1');
    header('Location: cart.php');
}


?>