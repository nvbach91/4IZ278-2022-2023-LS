<?php
define('__ROOT__', dirname(__FILE__, 5));
require_once __ROOT__ . "/App.php";
App::init();

header('Access-Control-Allow-Origin: https://www.vasedomena.cz');

header('Content-Type: application/json');

$server = $_POST['server'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$apiKey = $_SERVER['HTTP_X_API_KEY'] ?? '';

$response = [];

if ($server && $username && $password) {
    $ftp = new AccessConnection($server, $username, $password);

    if ($ftp->isConnected()) {
        $response['files'] = $ftp->listFiles();
    } else {
        $response['error'] = 'Nepodařilo se připojit k serveru';
    }

    $response['output'] = $ftp->getOutput();

    $_SESSION["ftp"] = $ftp;

} else {
    $response['error'] = 'Nedostatečné údaje pro připojení';
}



echo json_encode($response);

