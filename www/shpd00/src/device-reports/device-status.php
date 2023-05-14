<?php
require_once '../DBConnection.php';

$postData = file_get_contents('php://input');

$xml = simplexml_load_string($postData);

if(!empty($xml->serial)){
    var_dump($xml);
    $serial = $xml->serial;
    $key = $xml->key;
    $reportOffset = $xml->statusoffset;
    echo password_hash($key,PASSWORD_DEFAULT);
    $dbcon -> pushDeviceStatus($serial,$key,$reportOffset);
}
?>