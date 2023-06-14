<?php
define('__ROOT__', dirname(__FILE__, 6));
require_once __ROOT__ . "/App.php";
App::init();

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$ftp = $_SESSION["ftp"] ?? null;

$response = [];

if ($ftp && isset($ftp["server"],  $ftp["username"], $ftp["password"]) && isset($_FILES['file'])) {
    $ftp = new AccessConnection($ftp["server"], $ftp["username"], $ftp["password"]);

    if ($ftp->isConnected()) {
        $file = $_FILES['file']['tmp_name'];
        $destination = $_FILES['file']['name'];

        $ftp->uploadFile($file, $destination);
        $response['message'] = "File uploaded successfully.";
    } else {
        $response['error'] = 'Nepodařilo se připojit k serveru';
    }
} else {
    $response['error'] = 'Nedostatečné údaje pro připojení';
}

echo json_encode($response);


