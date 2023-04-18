<?php 

if(!empty($_GET)){
    session_start();
    if (!isset($_SESSION['selected_product'])) {
        $_SESSION['selected_product'] = array();
    }
    array_push($_SESSION['selected_product'],$_GET['good_id']);
    header('Location: ./cart.php');
}


?>