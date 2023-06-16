<?php
define('__ROOT__', dirname(__FILE__, 6));
require_once __ROOT__ . "/App.php";
App::init();

include_once "../header.php";


$ftp = $_SESSION["ftp"] ?? null;

if ($ftp && isset($ftp["server"],  $ftp["username"], $ftp["password"], $file)) {


    $ftp = new AccessConnection($ftp["server"], $ftp["username"], $ftp["password"]);

    if ($ftp->isConnected()) {
        $local_file ="../file/" . $file;

        $ftp->deleteLocalFile($local_file);
        $response['output'] = $ftp->getOutput();
    }

}else {
    $response['error'] = 'Nedostatečné údaje pro připojení nebo ke stažení souboru';
}
echo json_encode($response);
