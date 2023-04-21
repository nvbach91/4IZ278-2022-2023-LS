<?php
session_start();
require_once __DIR__ . '/database.php';

if (!empty($_GET['good_id'])) {
    $goods = [];
    $good_id = $_GET['good_id'];
    if (isset($_SESSION['goods'])) {
        $goods = $_SESSION['goods'];
    }
    $database = new Database();
    if ($database->goodExists($_GET['good_id'])) {
        array_push($goods, $_GET['good_id']);
        $_SESSION['goods'] = $goods;
        header('Location: cart.php');
        exit;
    }else{
        echo "<b>ERROR: Product with this ID doesn't exist.</b>";
    }
} else {
    header('Location: index.php');
    exit;
}
