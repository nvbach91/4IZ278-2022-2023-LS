<?php
    require_once "./session.php";

    if (!$authUser || !($authUser->privilege > 1)) {
        header('HTTP/1.0 403 Forbidden');
        exit('You are forbidden');
    }

    if (!isset($_GET['id']))
        exit('No product selected.');

    require_once __DIR__ . '/classes/ProductsDB.php';

    $productsDB = new productsDB();
    $product = $productsDB->delete($_GET['id']);

    header(sprintf('Location: %s', $_SERVER['HTTP_REFERER'] ?? 'index.php'));

    exit();