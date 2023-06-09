<?php 

if(!empty($_GET)){
    session_start();
    if (!isset($_SESSION['selected_product'])) {
        $_SESSION['selected_product'] = array();
        $_SESSION['product_quantity'] = array();
    }
    if(in_array($_GET['product_id'],$_SESSION['selected_product'])){
        $_SESSION['product_quantity'][array_search($_GET['product_id'], $_SESSION['selected_product'])]+=1;
        header('Location: cart.php?stare');
        exit;
    }
    array_push($_SESSION['selected_product'],$_GET['product_id']); 
    array_push($_SESSION['product_quantity'],1);
    header('Location: cart.php?nove');
}


?>