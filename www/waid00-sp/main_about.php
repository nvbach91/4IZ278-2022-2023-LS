<!DOCTYPE html>
<html lang="en"><?php
session_start();
$user = $_SESSION["user"];
$iduser = $_SESSION["iduser"];
$obsah = $_POST["textarea"];
include_once("by_database.php");
include_once("by_detection.php");
if (isset($_POST["pen"])){
  $_SESSION["edit"] = true;
}
if (isset($_POST["check"])){
  unset($_SESSION["edit"]);
  $sql = "UPDATE `_dmp_about` SET `Obsah` = '$obsah', `username` = '$user', `_dmp_users_ID` = '$iduser'";
  $data = $conn->prepare($sql);
  $data->execute();
}
if (isset($_POST["times"])) {
  unset($_SESSION["edit"]);
}
$data = $conn->prepare("SELECT Obsah FROM `_dmp_about`");
$data->execute();
$page = $data->fetch();
?>

<head>
  <title>DwGym - About</title>
  <link rel="stylesheet" href="css/about.css">
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
  <div class = "news">
    <form method="post">
      <?php
      if (isset($_SESSION["edit"])){
        echo ("<textarea name='textarea'>");
      }
      echo ($page["Obsah"]);
      if (isset($_SESSION["edit"])){
        echo ("</textarea>");
        if ($_SESSION["privilege"] == 2) {
        $buttonContent = "<button type=\"submit\" name=\"check\" class=\"edit\"><i class=\"fas fa-check\"></i></button>";
        echo $buttonContent;
        }}
        else{
          if ($_SESSION["privilege"] == 2) {
            $buttonContent2 = "<button type=\"submit\" name=\"pen\" class=\"edit\"><i class=\"fas fa-pen\"></i></button>";
        echo $buttonContent2;
          }}
          ?>
        </form>
      </div>
    </body>
    </html>
