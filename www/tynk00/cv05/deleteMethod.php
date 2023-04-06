<?php

require('database.php');

if(isset($_POST['user'])){
    $users->delete($_POST['user']);
}

if(isset($_POST['product'])){
    $products->delete($_POST['product']);
}

if(isset($_POST['order'])){
    $orders->delete($_POST['order']);
}

header('location: index.php');

?>