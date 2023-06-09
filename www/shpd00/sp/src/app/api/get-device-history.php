<?php
require_once '../../DBConnection.php';

require '../../session-check.php';
if(!$sessionIsValid){ 
    header("location: ../../logout.php");
    die; 
}

header("Content-type: application/json");

$jsonData = file_get_contents('php://input');
$requestData = json_decode($jsonData);
$deviceSerial = $requestData -> device_serial;

$user=$_COOKIE['username'];
$sessionToken=$_COOKIE['token'];
echo json_encode($dbcon->getDeviceHistory($user,$sessionToken,$deviceSerial,20,0));
 
?>