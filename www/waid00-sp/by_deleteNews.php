<?php
session_start();
include_once("by_detection.php");
include_once("by_database.php");
if ($_SESSION["privilege"] < 2){
  header("Location: main_news.php");
  exit();
}
  $data = $conn->prepare("DELETE FROM `_dmp_news` WHERE `ID` = ?");
  $data->execute([$_GET['ID']]);
      header('Location: main_news.php');
 ?>
