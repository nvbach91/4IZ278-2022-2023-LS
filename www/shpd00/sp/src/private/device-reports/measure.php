<?php
require_once '../../DBConnection.php';

$postData = file_get_contents('php://input');

$xml = simplexml_load_string($postData);

if(!empty($xml->serial)){
    var_dump($xml);
    $serial = $xml->serial;
    $key = $xml->key;
    $measureType = $xml->measuretype;
    $boolVal = $xml->boolval;
    $dbcon -> pushMeasure($serial,$key,$measureType,$boolVal);    
}
?>