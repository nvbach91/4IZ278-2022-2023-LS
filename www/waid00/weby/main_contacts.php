<?php
session_start();
include_once("by_database.php");
include_once("by_detection.php");
$user = $_SESSION["user"];
$iduser = $_SESSION["iduser"];
$obsah = $_POST["textarea"];
if (isset($_POST["pen"])){
  $_SESSION["edit"] = true;
}
if (isset($_POST["check"])){
  unset($_SESSION["edit"]);
  $sql = "UPDATE `_dmp_contacts` SET `Obsah` = '$obsah', `username` = '$user', `_dmp_users_ID` = '$iduser'";
  $data = $conn->prepare($sql);
  $data->execute();
}
if (isset($_POST["write_email"])) {
  header('Location: main_marketing.php');
}

if (isset($_POST["times"])) {
  unset($_SESSION["edit"]);
}
$data = $conn->prepare("SELECT Obsah FROM `_dmp_contacts`");
$data->execute();
$page = $data->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DwGym - Contacts</title>
  <link rel="stylesheet" href="css/contacts.css">
  <link rel="icon" href="" type="image/x-icon"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
  <script src="https://cdn.tiny.cloud/1/j8x5icayo126hiktp7gtz58j31m7i1jxt67my9mwklbb6b3q/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({ selector:'textarea', height: "480px" });</script>
  <?php
  include('main_header_style.php');
  ?>
</head>
<body>
  <?php include_once('main_header.php'); ?>
  <form method="post">
    <?php           if ($_SESSION["privilege"] == 2) { ?>
    <input type="Submit" name="write_email" value="Make a marketing e-mail" class="write_email">
  <?php } ?>
    <div class = "news"><?php
    if (isset($_SESSION["edit"])){
      echo ("<textarea name='textarea'>");
    }
    echo ($page["Obsah"]);
    if (isset($_SESSION["edit"])){
      echo ("</textarea>");
      if ($_SESSION["privilege"] == 2) {
        echo ("<button type=\"submit\" name=\"check\" class=\"edit\"><i class=\"fas fa-check\"></i></button>");
      }}
      else{
        if ($_SESSION["privilege"] == 2) {
          echo ("<button type=\"submit\" name=\"pen\" class=\"edit\"><i class=\"fas fa-pen\"></i></button>");
        }}
        ?>
        <?php if (!isset($_SESSION["edit"])){ ?>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57600563.886961766!2d-75.19882070507474!3d28.21765847391096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xadd28c30ec90d79%3A0x44652457c0696504!2zU2V2ZXJuw60gQXRsYW50c2vDvSBvY2XDoW4!5e0!3m2!1scs!2scz!4v1614807373831!5m2!1scs!2scz" width="400" height="300" style="border:0; position:absolute; top:50px; right:50px;" allowfullscreen="yes" loading="lazy"></iframe>
        <?php  } ?>


      </form>
    </div>
  </body>
  </html>
