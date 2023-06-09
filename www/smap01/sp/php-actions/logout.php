<?php
session_start();
if(isset($_COOKIE['user_email'])){
    setcookie('user_email', '', time());
    header('Location: index.php');
    exit;
}


?>