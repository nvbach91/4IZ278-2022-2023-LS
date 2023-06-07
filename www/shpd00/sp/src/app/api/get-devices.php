<?php
require_once '../../DBConnection.php';

require '../../session-check.php';
if(!$sessionIsValid){ 
    header("location: ../../logout.php");
    die; }

header("Content-type: application/json");

$user=$_COOKIE['username'];
$sessionToken=$_COOKIE['token'];
echo json_encode($dbcon->getUserDevices($user,$sessionToken));
 
?>