<?php 

session_start();
require_once 'auth.php';
requireLogin();

header('Location: ./index.php');
session_destroy();
?>