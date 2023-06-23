<?php
    session_start();
    if(isset($_GET["item_id"]) && isset($_SESSION["cart"])){
        $cart = $_SESSION["cart"];
        while (($key = array_search(htmlspecialchars($_GET["item_id"]), $cart)) !== false) {
            unset($cart[$key]);
        }
        $_SESSION["cart"] = $cart;
    }
        header("Location: ./checkout.php");
        exit;
?>