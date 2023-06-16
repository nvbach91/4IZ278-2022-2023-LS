<?php
define('__ROOT__', dirname(__FILE__, 6));
require_once __ROOT__ . "/App.php";
App::init();

include_once "../header.php";
$ftp = $_SESSION["ftp"] ?? null;


if ($ftp && isset($ftp["server"],  $ftp["username"], $ftp["password"]) && isset($_FILES['file'])) {
    $ftp = new AccessConnection($ftp["server"], $ftp["username"], $ftp["password"]);

    if ($ftp->isConnected()) {
        $file = $_FILES['file']['tmp_name'];
        $destination = $_FILES['file']['name'];

        $ftp->uploadFile($file, $destination);
        $response['output'] = "Soubor úspěšně nahrán";
    } else {
        $response['error'] = 'Nepodařilo se připojit k serveru';
    }
} else {
    $response['error'] = 'Nedostatečné údaje pro připojení';
}

echo json_encode($response);


