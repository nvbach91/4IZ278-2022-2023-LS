<?php
session_start();
include_once("by_detection.php");
include_once("by_database.php");
if (!isset($_SESSION["user"])){
  header("Location: main_login.php");
  exit();
}
$data = $conn->prepare("DELETE FROM `_dmp_booking` WHERE `username` = ? AND `day` = ? AND `time` = ? AND `week` = ?");
    $data->execute([$_SESSION["user"], $_GET['day'] , $_GET['time'], $_GET['week']]);
    if ($_GET['week'] == '0') {
      header('Location: main_booking.php');
    }
    else {
      header('Location: main_booking_next.php');
    }
 ?>
