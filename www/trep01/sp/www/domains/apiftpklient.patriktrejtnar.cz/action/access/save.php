<?php
define('__ROOT__', dirname(__FILE__, 6));
require_once __ROOT__ . "/App.php";
App::init();

include_once "../header.php";

if (isset ($_SESSION["user"])){
    $db = new Database();
    $AccessesR = new AccessesRepository($db);

    if(!isset($access_name))
        $access_name = $access_server;

        $access_id = $AccessesR->addAccess($access_name,$access_server,$access_username,$access_password);

        $UserAccessesR = new UserAccessesRepository($db);

        if(!isset($user_note))
            $user_note = "your note";


        $UserAccessesR->addUserAccess($access_id, $_SESSION["user"]["id_user"],$user_note);
        $response['output'] = 'Access přidán';

        $response['access_id'] = $access_id;

}else{
    $response['error'] = 'Uživatel nepříhlašen';
}

echo json_encode($response);
