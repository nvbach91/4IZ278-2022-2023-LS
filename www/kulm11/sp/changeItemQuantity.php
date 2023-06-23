<?php
    session_start();

    if(!isset($_COOKIE["username"])){
        header("Location: ./login.php");
        exit;
    }

    if(!isset($_GET["type"]) || !isset($_GET["id"])){
        header("Location: ./checkout.php");
        exit;
    }
    $type=htmlspecialchars($_GET["type"]);
    $id=htmlspecialchars($_GET["id"]);
    $idList=$_SESSION["cart"];

    if($type=="add"){
        require_once "./database/ItemsDatabase.php";
        $itemDB = new ItemsDatabase();
        if(isset($_SESSION["cart"])){
            $cart = $_SESSION["cart"];
        }
        if($itemDB->containsItem($id)){
            array_push($idList, $id);
            $_SESSION["cart"]=$idList;
        }
    }elseif($type=="remove"){
        if(isset($id) && isset($_SESSION["cart"])){
            if (($key = array_search($id, $idList)) !== false) {
                unset($idList[$key]);
            }
            $_SESSION["cart"] = $idList;
        }
    }
    header("Location: ./checkout.php");
    exit;
