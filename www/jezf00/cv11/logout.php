<?php 

session_start();
require_once 'auth.php';
requireLogin();

setcookie('username', '', time());
header('Location: ./index.php');
session_destroy();
?>