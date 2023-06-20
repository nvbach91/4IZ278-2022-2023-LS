<?php
session_start();
if(!isset($_COOKIE["username"])){
    header("Location: ./login.php");
    exit;
}
if(!isset($_GET["item_id"])){
    header("Location: ./index.php");
    exit;
}
require_once "./database/ItemsDatabase.php";
$itemDB = new ItemsDatabase();
$cart = [];
$itemID = $_GET["item_id"];
if(isset($_SESSION["cart"])){
    $cart = $_SESSION["cart"];
}
if($itemDB->containsItem($itemID)){
    array_push($cart, $itemID);
    $_SESSION["cart"]=$cart;
    header("Location: ./index.php#items");
    exit;
}
else{
    echo "error";
}



?>