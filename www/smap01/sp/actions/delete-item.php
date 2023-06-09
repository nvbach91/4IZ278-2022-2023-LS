<?php
session_start();
require_once("../database/ProductsDB.php");
require_once("../database/UsersDB.php");

$productsDB = ProductsDB::getDatabase();
$usersDB = UsersDB::getDatabase();

//First enter and input tests
if(empty($_COOKIE)||!isset($_COOKIE['user_email'])&&$usersDB->getUserPrivilege(htmlspecialchars($_COOKIE['user_email']))<2){
    header('Location: ../login.php');
    exit;
}

//If all criteria are met a book given by the _GET is deleted from the database
if (!empty($_COOKIE['user_email'])&&isset($_GET['book_id']) && $productsDB->bookExists(htmlspecialchars($_GET['book_id'])) == true&&$usersDB->getUserPrivilege(htmlspecialchars($_COOKIE['user_email']))>1) {
    $result = $productsDB->deleteItem(htmlspecialchars($_GET['book_id']));
    if ($result == null) {
        header('Location: ../index.php');
        exit;
    } else {
        echo $result;
    }
} else {
    header('Location: ../index.php');
}
