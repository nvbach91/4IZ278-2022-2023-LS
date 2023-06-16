<?php

define('__GROOT__',dirname(__FILE__, 4));
require_once __GROOT__ . '/App.php';
App::init();

$loginError = false;

$db = new Database(); //vytvoří instaci třídy pro komunikaci s databází

if (isset($_POST["user_email"], $_POST["user_password"])) //autorizace přihlášení
{
    $usersR = new UsersRepository($db);
    $user = $usersR->getUserByEmail($_POST["user_email"]);

    if($user === false){
        $loginError = true;
    }else{

        if (password_verify($_POST["user_password"] ,$user["user_password"]))
        {
            unset($user["user_password"]);
            unset($user[2]);
            $_SESSION["user"] = $user;

            session_regenerate_id();

            header("location: /index.php");
        }else{
            $loginError = true;
            header("location: /admin/login.php");
        }
    }
}
