<?php
session_start();
include_once("by_detection.php");
include_once("by_database.php");
if ($_SESSION["privilege"] < 2){
  header("Location: main_news.php");
  exit();
}
$data = $conn->prepare("UPDATE `_dmp_booking_cells` SET `name` = NULL AND `max` = NULL WHERE `day` = ? AND `time` = ?");
$data->execute([$_GET['day'] , $_GET['time']]);
$data = $conn->prepare("DELETE FROM `_dmp_booking` WHERE `day` = ? AND `time` = ?");
$data->execute([$_GET['day'] , $_GET['time']]);

header('Location: main_booking.php');

?>
