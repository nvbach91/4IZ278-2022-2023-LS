<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'config.php';
require 'github-config.php';

fetchData();
if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

$_SESSION['user_email'] = $_SESSION['payload']['email'];
$_SESSION['user_name'] = $_SESSION['payload']['username'];


header('Location: ./customer_php/home.php');
exit;
