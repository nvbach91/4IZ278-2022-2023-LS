<?php
session_start();
require_once("./database.php");

$database = new Database();

if(empty($_COOKIE)||!isset($_COOKIE['user_email'])&&$database->getUserPrivilege($_COOKIE['user_email'])<2){
    header('Location: login.php');
    exit;
}

if (!empty($_COOKIE['user_email'])&&isset($_GET['good_id']) && $database->goodExists($_GET['good_id']) == true&&$database->getUserPrivilege($_COOKIE['user_email'])>1) {
    $result = $database->deleteItem($_GET['good_id']);
    if ($result == null) {
        header('Location: index.php');
        exit;
    } else {
        echo $result;
    }
} else {
    header('Location: index.php');
}
