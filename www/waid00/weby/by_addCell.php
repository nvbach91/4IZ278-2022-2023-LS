<?php
session_start();
if ($_SESSION["privilege"] < 2){
  header("Location: main_news.php");
  exit();
}
if (!isset($_SESSION["user"]) AND $_SESSION["privilege"] == 2){
  header("Location: main_login.php");
  exit();
}
include_once("by_database.php");
include_once("by_detection.php");
if(isset($_GET['submit'])){
  $data = $conn->prepare("UPDATE `_dmp_booking_cells` SET `name` = 'x', `_dmp_booking_lessons_ID` = ?, `max` = ?, `_dmp_users_ID` = ? WHERE `day` = ? AND `time` = ?");
  $data->execute([$_GET['addLesson'], $_GET['max'], $_GET['addTrainer'],  $_GET['getDay'], $_GET['getTime']]);
  header('Location: main_booking.php');
}
?>
<!DOCTYPE html>
<html lang="cs" dir="ltr">
<head>
  <link rel="stylesheet" href="css/about.css">
  <meta charset="utf-8">
  <title>DwGym</title>
  <?php
  include('main_header_style.php');
  ?>
</head>
<body>
  <?php include_once('main_header.php'); ?>
  <form method="get">
    <div class = "choose_news">
      <input type="text" name="getDay" value='<?php echo $_GET['day']; ?>' hidden>
      <input type="text" name="getTime" value='<?php echo $_GET['time']; ?>' hidden>

      <label for="name" class="choose_lesson">Lesson</label>
      <select name="addLesson" size="1" class="select1" required>
        <?php
        $sql = "SELECT `ID`,`name` FROM `_dmp_booking_lessons` WHERE `ID` != '' ORDER BY `name` ASC";
        $data = $conn->query($sql);
        $vysledek = $data->fetchAll();
        foreach ($vysledek as $row) {
          $idlesson = $row['ID'];
          echo "<option value='".$idlesson."'>".$row['name']."</option>";
        }
        ?>
      </select>

      <label for="max" class="max_amount">Max amount of users</label>
      <input type="number" name="max" value="10"  min="1" class="max" max="50" required>


      <label for="name" class="choose_trainer">Trainer</label>
      <select name="addTrainer" size="1" class="trainer">
        <?php
        $sql = "SELECT `ID`, `forename`, `surname` FROM `_dmp_users` WHERE `privileges` = '1' ORDER BY `surname`, `forename` ASC";
        $data = $conn->query($sql);
        $vysledek = $data->fetchAll();
        foreach ($vysledek as $row) {
          $idtrainer = $row['ID']; 
          echo "<option value=$idtrainer>".$row['forename']." ".$row['surname']."</option>";
        }
        ?></select>

        <input type="submit" name="submit" value="add" class="add">
      </div>
    </form>
  </body>
  </html>

  </html>
