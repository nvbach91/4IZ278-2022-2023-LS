<?php require_once '../models/UsersDB.php' ?>
<?php
session_start();

$usersDatabase = new UsersDatabase();

$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$current_user = $usersDatabase->fetchById($user_id);



