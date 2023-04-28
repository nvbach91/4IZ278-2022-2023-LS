<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$query = 'SELECT * FROM cv10_users WHERE user_id = :user_id LIMIT 1';
$statement = $pdo->prepare($query); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
$statement->execute(['user_id' => $_SESSION['user_id']]);

$current_user = $statement->fetchAll()[0];
?>