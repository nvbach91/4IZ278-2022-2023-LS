<?php
define('__ROOT__', dirname(__FILE__, 6));
require_once __ROOT__ . "/App.php";
App::init();

include_once "../header.php";

if (isset ($_SESSION["user"]) AND $id_access !=null AND $email !=null){

    $db = new Database();
    $UserR = new UsersRepository($db);

    $User = $UserR->getUserByEmail($email); //TODO: kontrola

    if ($User != null){
        $UserAccessesR = new UserAccessesRepository($db);

        $UserAccessesR->addUserAccess( $id_access,$User["id_user"],"note");

        $response['output'] = 'Access nasdílen';
        include_once "../../email/send.php";
    }


}else{
    $response['error'] = 'Uživatel nepříhlašen';
}

echo json_encode($response);