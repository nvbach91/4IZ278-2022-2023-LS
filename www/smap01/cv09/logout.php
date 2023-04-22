<?php
session_start();
if(isset($_COOKIE['name'])){
    setcookie('name', '', time());
    header('Location: index.php');
    exit;
}


?>