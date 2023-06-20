<?php
require_once "./database/UsersDatabase.php";
$usersDatabase = new UsersDatabase();

if(!isset($_COOKIE["username"]) || !$usersDatabase->isAdmin($_COOKIE["username"])){
    header("Location: ./login.php");
    exit;
}

if(isset($_GET["item_id"])){
    require_once "./database/ItemsDatabase.php";
    $itemsDatabase = new ItemsDatabase();
    if($itemsDatabase->containsItem($_GET["item_id"])){
        $itemsDatabase->removeItem($_GET["item_id"]);
    }
}
elseif(isset($_GET["user_id"])){
    if($usersDatabase->containsUser($_GET["user_id"])){
        $usersDatabase->removeUser($_GET["user_id"]);
    }
}
header("Location: ./admin.php");
exit;
?>