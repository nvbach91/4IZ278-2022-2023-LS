<?php
    require_once "./database/ItemsDatabase.php";
    require_once "./database/UsersDatabase.php";
    require_once "./database/OrdersDatabase.php";

    session_start();

    $itemsDB = new ItemsDatabase();
    $usersDB = new UsersDatabase();
    $ordersDB = new OrdersDatabase();

    if(!isset($_SESSION["cart"])){
        header("Location: ./index.php");
        exit;
    }

    if(!isset($_COOKIE["username"])){
        header("Location: ./login.php");
        exit;
    }

    $user = $usersDB->getUserViaEmail($_COOKIE["username"]);
    $itemsIDs = $_SESSION["cart"];
    $totalprice = 0;
    foreach($itemsIDs as $itemID){
        $item = $itemsDB->fetch($itemID);
        $totalprice = $totalprice + $item["price"];
    }

    $ordersDB->createOrder(date("Y-m-d"), $totalprice, $user["userid"], htmlspecialchars($_POST["shipping"]), htmlspecialchars($_POST["payment"]));
    $orderID = $ordersDB->getLastID();

    $quantities = array_count_values($itemsIDs);
    
    foreach(array_unique($itemsIDs) as $temp){
        $quantity=$quantities[$temp];
        $itemsPrice=$quantity*$itemsDB->fetch($temp)["price"];
        $ordersDB->createOrderItem($quantity,$itemsPrice,$orderID,$temp);
    }

    $_SESSION["cart"]=[];
    header("Location: ./orderhistory.php");
    exit;
