<?php

session_start();

/**
 * @return object|false
 */
function getAuthUser()
{
    if (!isset($_COOKIE['email']))
        return false;

    require_once "./classes/UsersDB.php";

    $usersDatabase = new UsersDB;
    $user = $usersDatabase->fetchByEmail($_COOKIE['email']);
    return $user ? (object) $user : false;
}

$authUser = getAuthUser();