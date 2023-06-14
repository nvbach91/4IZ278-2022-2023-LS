<?php
session_start();
include_once("by_detection.php");
include_once("by_database.php");
if ($_SESSION["privilege"] < 2){
  header("Location: main_news.php");
  exit();
}
for ($deleteRow = 0; $deleteRow <= 7 ; $deleteRow++) {
  $data = $conn->prepare("DELETE FROM `_dmp_booking_cells` WHERE `time` = ? AND `day` = $deleteRow");
  $data->execute([$_GET['time']]);
      header('Location: main_booking.php');
}
 ?>
