<?php 

if(!empty($_GET)) {
    session_start();
    var_dump($_SESSION["cart"]);
    if (!empty($_GET['good_id'])) {
        if (isset($_SESSION['cart'])) {
            $index = array_search($_GET['good_id'], $_SESSION['cart']);
            var_dump($index);
            if ($index !== false) {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); 
            }
        }
    }
    header('Location: cart.php');
}

?>