<?php
session_start();
require_once 'dbconfig.php';
require_once 'auth.php';
requirePrivilege(3);

if (isset($_POST['user_id']) && isset($_POST['privilege'])) {
    $user_id = $_POST['user_id'];
    $privilege = $_POST['privilege'];

    $pdo = new PDO(
        'mysql:host=' . DB_HOST .
            ';dbname=' . DB_NAME .
            ';charset=utf8mb4',
        DB_USERNAME,
        DB_PASSWORD
    );

    $statement = $pdo->prepare('UPDATE cv10_users SET privilege = :privilege WHERE id = :user_id');
    $statement->bindParam(':privilege', $privilege, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->execute();

    header('Location: users.php');
} else {
    header('Location: users.php');
}
