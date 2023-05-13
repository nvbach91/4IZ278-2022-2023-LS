<?php 

if(!empty($_GET)){
    session_start();
    if (!isset($_SESSION['selected_product'])) {
        $_SESSION['selected_product'] = array();
    }
    
    while (($id = array_search($_GET['good_id'], $_SESSION['selected_product'])) !== false){

    unset($_SESSION['selected_product'][$id]);

    }
    $_SESSION['selected_product'] = array_values($_SESSION['selected_product']);
    header('Location: ./cart.php');
}

?>