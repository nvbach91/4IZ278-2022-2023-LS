<?php
session_start();
if(!empty($_POST)){
$_SESSION['adress'] = [
    'adress' => $_POST['adress'],
    'postalCode' => $_POST['postalCode'],
    'phone' => $_POST['phone']
];
header("Location: cart.php");
}