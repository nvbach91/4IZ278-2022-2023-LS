<?php 
require_once 'index.php';
$completeOrder = new completeOrder();
$completeOrder -> completeOrder($_POST['order_id']);
header("Location: admin.php");