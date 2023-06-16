<?php require_once './UserDatabase.php'; ?>
<?php

function isLoggedIn()
{
    $userDatabase = new UserDatabase();
    if(isset($_SESSION['user']) && !$userDatabase->getUserById($_SESSION['user']['user_id'])){
        header('Location: ./logout.php');
    }
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
