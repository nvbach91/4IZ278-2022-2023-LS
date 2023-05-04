<?php

session_start();

/**
 * @return object|false
 */
function getAuthUser()
{
    if (isset($_COOKIE['facebook'])) {
        $data = json_decode($_COOKIE['facebook']);

        $user = new stdClass;
        $user->privilege = 1;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->user_id = $data->user_id;

        return $user;
    }

    if (!isset($_COOKIE['email']))
        return false;

    require_once "./classes/UsersDB.php";

    $usersDatabase = new UsersDB;
    $user = $usersDatabase->fetchByEmail($_COOKIE['email']);
    return $user ? (object) $user : false;
}

$authUser = getAuthUser();