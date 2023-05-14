<?php

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header('Location: ./login.php');
        exit;
    }
}

function requirePrivilege($requiredPrivilege)
{
    if (!isLoggedIn() || $_SESSION['user']['privilege'] < $requiredPrivilege) {
        header('Location: ./login.php');
        exit;
    }
}
