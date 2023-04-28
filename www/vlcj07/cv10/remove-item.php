

<?php
session_start();
require './db/db.php';
require 'authorization.php';

if (isset($_SESSION['cart'])) {
    $goodId = $_GET['good_id'];
    $id = array_search($goodId, $_SESSION['cart']);
    if ($id !== false) {
        unset($_SESSION['cart'][$id]);
    }
}

header('Location: ./cart.php');
?>