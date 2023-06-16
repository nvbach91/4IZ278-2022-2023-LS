<?php
define('__ROOT__', dirname(__FILE__, 6));
require_once __ROOT__ . "/App.php";
App::init();

include_once "../header.php";

if (isset ($_SESSION["user"])){
    $db = new Database();
    $UserAccessesR = new UserAccessesRepository($db);

    $response['accessList'] = $UserAccessesR ->getUserAccesses($_SESSION["user"]["id_user"]);
}else{
    $response['error'] = 'Uživatel nepřihlášen';
}

echo json_encode($response);