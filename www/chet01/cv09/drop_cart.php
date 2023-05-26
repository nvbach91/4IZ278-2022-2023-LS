<?php
session_start();
if (isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
header('Location:index.php');
