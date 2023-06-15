<?php

session_start();
require_once '../auth.php';
requireLogin();
requirePrivilege(2);

if (!empty($_GET['category_id'])) {
    require_once '../dbconfig.php';
    $pdo = new PDO(
        'mysql:host=' . DB_HOST .
            ';dbname=' . DB_NAME .
            ';charset=utf8mb4',
        DB_USERNAME,
        DB_PASSWORD
    );

    $category_id = $_GET['category_id']; 
    $stmt = $pdo->prepare('DELETE FROM sp_categories WHERE category_id = :category_id');   

    $stmt->execute(['category_id' => $category_id]);

    header('Location: ../index.php');
    exit;
} else {
    header('Location: ../index.php');
    exit;
}
