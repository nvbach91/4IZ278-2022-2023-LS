<?php
define('__ROOT__', dirname(__FILE__, 6));
require_once __ROOT__ . "/App.php";
App::init();

include_once "../header.php";

if (isset($user_password,$user_email))
{
    $db = new Database(); //vytvoří instace třídy pro komunikaci s databází
    $UsersR = new UsersRepository($db);

    $user = $UsersR->getUserByEmail($user_email);

    if($user)
    {

        if (password_verify($user_password,$user["user_password"])) //pokud je přihlášení úspěšné
            {
                unset($user["user_password"]);
                unset($user[2]);
                $_SESSION["user"] = $user;
                session_regenerate_id();

            }else {
            $response['error'] = 'Neplatné heslo';
        }
    }
    else {
        $response['error'] = 'Uživatel neexistuje';
    }



}
$response['user'] = $_SESSION["user"];
echo json_encode($response);