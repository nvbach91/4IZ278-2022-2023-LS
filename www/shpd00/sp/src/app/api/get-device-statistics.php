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
echo json_encode($dbcon->getDeviceStatistics($user,$sessionToken,$deviceSerial,'2023-06-07','2023-06-09'));
 
?>