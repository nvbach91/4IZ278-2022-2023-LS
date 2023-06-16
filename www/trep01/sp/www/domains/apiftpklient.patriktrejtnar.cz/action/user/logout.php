<?php
define('__ROOT__', dirname(__FILE__, 6));
require_once __ROOT__ . "/App.php";
App::init();

include_once "../header.php";

if (isset($_SESSION["user"]))
{
    session_destroy();
}else {
    $response['error'] = 'Uživatel nebyl přihlášen';
}

$response['accessList'] = null;
$response['user'] = null;
echo json_encode($response);