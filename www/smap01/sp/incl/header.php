<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/stylesheet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bd033b307b.js" crossorigin="anonymous"></script>
    <title>Book-shop</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="https://esotemp.vse.cz/~smap01/cv09/index.php">Book-shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create-item.php">Create item</a>
                </li>
                <li>
                    <?php
                    
                        require_once("./database/Database.php");
                        $database=new Database();
                        echo (!empty($_COOKIE)&&isset($_COOKIE['user_email'])&&$database->getUserPrivilege($_COOKIE['user_email'])>2)?
                        '<a class="nav-link" href="users.php">All users</a>':'';
                    
                    ?>
                </li>
            </ul>
            <a class="my-2 my-lg-0" href="profile.php" style="margin-right:5px;color:white;"><?php echo isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : ''; ?></a>
            <?php

            $numGoods = isset($_SESSION['goods']) ? count($_SESSION['goods']) : 0;
            echo '<a href="cart.php" class="my-2 my-lg-0" style="margin-right:5px;color:white;"><i class="fa-sharp fa-solid fa-cart-shopping"></i> ' . $numGoods . '</a>';

            ?>
            <?php if (!isset($_COOKIE['user_email'])) {
                echo '<a href="login.php" class="btn btn-success my-2 my-lg-0" style="margin-right:5px;">Login</a>';
            } else {
                echo '<a href="logout.php" class="btn btn-danger my-2 my-lg-0" style="margin-right:5px;">Logout</a>';
            }
            ?>
        </div>
    </nav>