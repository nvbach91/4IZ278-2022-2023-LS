<?php 
require 'authorization.php';
unset($_SESSION['cart']);

header('Location: ../views/cart.php');
?>