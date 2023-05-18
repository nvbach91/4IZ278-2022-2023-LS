<?php 
if (!empty($_GET["product_id"])) {
    require_once "db.php";

    session_start();
    $cart = $_SESSION["cart"];
    
    $product_id = $_GET["product_id"];
    $query = "SELECT name,price FROM product WHERE product_id=:product_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(["product_id" => $product_id,]);
    $product = $stmt->fetch();
    
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


header("Location: index.php");
?>