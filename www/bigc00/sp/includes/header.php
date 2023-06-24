<?php
require_once('../database/UsersDB.php');
session_start();
$usersDB = new UsersDB();
$isAdmin = isset($_SESSION['user']) ? $usersDB->getOne('user_id', $_SESSION['user'])['permissions'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../styles/styles.css'>
    <title>Vanguard Bank</title>
</head>

<body>
    <div class='header'>
        <a class='brand' href='../index.php'>
            <img src='../img/logo.png'>
            <p>Vanguard Bank</p>
        </a>
        <div class='rightside' id='header'>
            <?php if ($isAdmin) : ?>
                <a class='login-btn' href='../includes/adminPanel.php' style='right: 10px;'>
                    <p>Admin Panel</p>
                </a>
            <?php endif; ?>
            <?php if (!isset($_SESSION['user'])) : ?>
                <a class='login-btn' href='../includes/login.php'>
                    <p>Login</p>
                </a>
            <?php else : ?>
                <a class='login-btn' href='../includes/main.php'>
                    <p>Logout</p>
                </a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>