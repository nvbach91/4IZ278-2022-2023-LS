<?php
session_start();
require_once("./database.php");

$database = new Database();

if (!empty($_COOKIE['name'])&&isset($_GET['good_id']) && $database->goodExists($_GET['good_id']) == true) {
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
