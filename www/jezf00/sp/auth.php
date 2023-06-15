<?php

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        if (isset($_SESSION['saved_cart'])) {
            $_SESSION['cart'] = $_SESSION['saved_cart'];
            unset($_SESSION['saved_cart']);
        }
        if (isset($_SESSION['cart'])) {
            header('Location: ./user/login.php?return_to=cart.php');
        } else {
            header('Location: ./user/login.php');
        }
        exit;
    }
}


function requirePrivilege($requiredPrivilege)
{
    if (!isLoggedIn() || $_SESSION['user']['privilege'] < $requiredPrivilege) {
        if (isset($_SESSION['cart'])) {
            $_SESSION['saved_cart'] = $_SESSION['cart'];
            header('Location: ../user/login.php?return_to=cart.php');
        } else {
            header('Location: ../user/login.php');
        }
        exit;
    }
}


