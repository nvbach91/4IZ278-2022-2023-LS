<?php 
require_once "db.php";
if (!empty($_GET["product_id"])) {
    session_start();
    $product_id = htmlentities($_GET["product_id"]);
    $query = "SELECT * FROM product WHERE product_id=:product_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(["product_id" => $product_id,]);
    $data = $stmt->fetch();
    
    if (!empty($data)) {
        array_push($_SESSION["cart"], $product_id);
    } else {
        $_SESSION["error"] = "Item not found";  
    }
    
}

// var_dump($data);
// var_dump($_SESSION["cart"]);
header("Location: index.php");
?>