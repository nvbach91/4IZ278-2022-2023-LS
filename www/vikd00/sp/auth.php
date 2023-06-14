<?php

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header('Location: ./index.php');
        exit;
    }
}

function requirePrivilege($requiredPrivilege)
{
    if (!isLoggedIn() || $_SESSION['user']['role'] < $requiredPrivilege) {
        header('Location: ./index.php');
        exit;
    }
}

function isAdmin()
{
    if (isLoggedIn() && $_SESSION['user']['role'] >= 2) {
        return true;
    }
    return false;
}
