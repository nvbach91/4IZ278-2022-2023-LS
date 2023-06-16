<?php
define('__ROOT__', dirname(__FILE__, 5));
require_once __ROOT__ . "/App.php";
App::init();

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"), true);

foreach($data as $key => $value){
    $$key = $value;
}

$apiKey = $_SERVER['HTTP_X_API_KEY'] ?? '';

$response = [];

$ftp = $_SESSION["ftp"] ?? null;


if ($ftp && isset($ftp["server"],  $ftp["username"], $ftp["password"], $directory)) {


    $ftp = new AccessConnection($ftp["server"], $ftp["username"], $ftp["password"]);

    if ($ftp->isConnected()) {
        if($directory == '..'){
            $ftp->changeToParentDirectory();

        }else{
            $ftp->changeDirectory($directory);
        }
        $_SESSION["ftp"]["directory"] = $ftp->getCurrentDirectory();
        $response['files'] = $ftp->listFiles();
    } else {
        $response['error'] = 'Nepodařilo se připojit k serveru';
    }

    $response['output'] = $ftp->getOutput();


} else {
    $response['error'] = 'Nedostatečné údaje pro připojení';
}

$response['currentDirectory'] = $_SESSION["ftp"]["directory"];

echo json_encode($response);
