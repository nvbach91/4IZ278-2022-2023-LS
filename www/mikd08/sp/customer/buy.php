<?php 
if (!empty($_GET["product_id"])) {
    require_once __DIR__."/../db.php";

    session_start();
    $cart = $_SESSION["cart"];
    $product_id = $_GET["product_id"];

    $product = customFetch("SELECT name,price FROM product WHERE product_id=?",[$product_id => PDO::PARAM_INT],false);
    
    if (!empty($product)) {
        if (array_key_exists($product_id, $cart)) {
            $cart[$product_id]["amount"] += 1;
        } else {
            $cart[$product_id]["amount"] = 1;
            $cart[$product_id]["price"] = $product["price"];
            $cart[$product_id]["name"] = $product["name"];

        }
        $_SESSION["cart"] = $cart;
    } else {
        $_SESSION["error"] = "Item not found";  
    }
    
}


header("Location: /www/mikd08/sp/index.php");
?>