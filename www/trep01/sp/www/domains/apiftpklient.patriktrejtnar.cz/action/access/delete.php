<?php
define('__ROOT__', dirname(__FILE__, 6));
require_once __ROOT__ . "/App.php";
App::init();

include_once "../header.php";

if (isset ($_SESSION["user"]) AND isset($id_access)){
    $db = new Database();
    $UserAccessesR = new UserAccessesRepository($db);

    $UserAccessesR->deleteUserAccess($id_access);

    $AccessesR = new AccessesRepository($db);

    $AccessesR->deleteAccess($id_access);

    $response['success'] = 'Úspěch smazán access';
}else{
    $response['error'] = 'Uživatel nepříhlašen';
}

echo json_encode($response);
