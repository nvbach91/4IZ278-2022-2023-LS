<?php

session_start();
require_once '../auth.php';
requireLogin();
requirePrivilege(2);

if (!empty($_GET['good_id'])) {
    require_once '../dbconfig.php';
    $pdo = new PDO(
        'mysql:host=' . DB_HOST .
            ';dbname=' . DB_NAME .
            ';charset=utf8mb4',
        DB_USERNAME,
        DB_PASSWORD
    );

    $good_id = $_GET['good_id'];
    
    $stmt = $pdo->prepare('DELETE FROM sp_products WHERE good_id = :good_id');
    $stmt->execute(['good_id' => $good_id]);

    header('Location: ../index.php');
    exit;
} else {
    header('Location: ../index.php');
    exit;
}
