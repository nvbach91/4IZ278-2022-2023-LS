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

$response = [];

$ftp = $_SESSION["ftp"] ?? null;

if ($ftp && isset($ftp["server"],  $ftp["username"], $ftp["password"], $file)) {
    $ftp = new AccessConnection($ftp["server"], $ftp["username"], $ftp["password"]);

    if ($ftp->isConnected()) {
        // Lokální název souboru je stejný jako vzdálený
        $local_file ="../file/" . $file;
        $file =$_SESSION["ftp"]["directory"] . "/" . $file;
        $ftp->downloadFile($file, $local_file);

        $response['output'] = $ftp->getOutput();
    } else {
        $response['error'] = 'Nepodařilo se připojit k serveru';
    }
} else {
    $response['error'] = 'Nedostatečné údaje pro připojení nebo ke stažení souboru';
}

echo json_encode($response);

