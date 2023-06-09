<?php 

if(!empty($_GET)){
    session_start();
    if (!isset($_SESSION['selected_product'])) {
        $_SESSION['selected_product'] = array();
        $_SESSION['product_quantity'] = array();
    }
    
    while (($id = array_search($_GET['product_id'], $_SESSION['selected_product'])) !== false){

    unset($_SESSION['selected_product'][$id]);
    unset($_SESSION['product_quantity'][$id]);

    }
    $_SESSION['selected_product'] = array_values($_SESSION['selected_product']);
    $_SESSION['product_quantity'] = array_values($_SESSION['product_quantity']);
    header('Location: cart.php');
}

?>