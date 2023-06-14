<?php
define('__ROOT__', dirname(__FILE__, 6));
require_once __ROOT__ . "/App.php";
App::init();

include_once "../header.php";

if (isset($user_password,$user_email))
{
    $db = new Database(); //vytvoří instace třídy pro komunikaci s databází
    $UsersR = new UsersRepository($db);

    $existingUser = $UsersR->getUserByEmail($user_email);

    if (!$existingUser ) {
        $UsersR->addUser($user_email,$user_password);
    }
}

echo json_encode($response);