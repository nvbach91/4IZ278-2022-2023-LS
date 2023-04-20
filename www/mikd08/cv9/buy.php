<?php 
require_once "db.php";
if (!empty($_GET)) {
    session_start();

    if (!empty($_GET["good_id"])) {
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }

        $query = "SELECT * FROM cv09_goods WHERE good_id=:good_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(["good_id" => $_GET["good_id"],]);
        $data = $stmt->fetch();
        
        if (!empty($data)) {
            array_push($_SESSION["cart"], $_GET["good_id"]);
        } else {
            $_SESSION["error"] = "Item not found";  
        }
        
    }
}
// var_dump($data);
// var_dump($_SESSION["cart"]);
header("Location: ./index.php");
?>