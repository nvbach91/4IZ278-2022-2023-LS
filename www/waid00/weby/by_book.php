<?php
session_start();
include_once("by_detection.php");
include_once("by_database.php");
if (!isset($_SESSION["user"])){
  header("Location: main_login.php");
  exit();
}
$day = $_GET['day'];
$time = $_GET['time'];
$sql = "SELECT `ID` FROM `_dmp_booking_cells` WHERE `day` = '$day' AND `time` = '$time'";
$dataid = $conn->prepare($sql);
$dataid->execute();
foreach ($dataid as $value) {

  $data = $conn->prepare("INSERT INTO `_dmp_booking` (`ID`, `username`, `day`, `time`,`week`,  `_dmp_users_ID`, `_dmp_booking_cells_ID`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
  $data->execute([$_SESSION["user"], $_GET['day'] , $_GET['time'], $_GET['week'],$_SESSION["iduser"], $value['ID']]);
  if ($_GET['week'] == '0') {
    header('Location: main_booking.php');
  }
  else {
    header('Location: main_booking_next.php');
  }
}
?>
