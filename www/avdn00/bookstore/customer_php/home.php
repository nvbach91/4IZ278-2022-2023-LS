<?php

include '../config.php';
session_start(); 

$user_id = $_SESSION['user_id'];

if(!isset($user_id)) {
    header('location:../login.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
</head>
<body>
    <h1>Home page</h1>
</body>
</html>