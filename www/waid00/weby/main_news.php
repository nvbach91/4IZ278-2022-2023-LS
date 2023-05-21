<?php
session_start();
include_once("by_database.php");
include_once("by_detection.php");
if(isset($_POST['addMyWork'])){
  $data = $conn->prepare("INSERT INTO `_dmp_news` (`ID`, `title`, `subtitle`, `text`, `datetime`, `date`, `username`) VALUES (NULL, ?, ?, ?, current_timestamp(), current_timestamp(), ?);");
  $data->execute([$_POST['title'], $_POST['subtitle'], $_POST['text'], $_SESSION["user"]]);
  header("Location: main_news.php");
}
if(isset($_POST['submitfore'])){
  $data = $conn->prepare("UPDATE `_dmp_users` SET `forename` = ?, `surname` = ? WHERE `username` = ?");
  $data->execute([$_POST["newfore"], $_POST["newsur"], $_SESSION["user"]]);
  $_SESSION["forename"] = $_POST["newfore"];
  $_SESSION["surname"] = $_POST["newsur"];
  header("Location: main_news.php");
}
$news = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dave with Gym</title>
  <link rel="icon" href="#" type="image/x-icon"/>
  <link rel="stylesheet" href="css/news.css">
  <?php
  include('main_header_style.php');
  ?>
</head>
<body>
  <?php include_once('main_header.php'); ?>
  <form method="post">
    <?php if(!isset($_POST['addNews'])){
      ?>
      <div class='news'>
        <h1 style="text-decoration: underline; text-align:center;">News</h1>
        <?php if ($_SESSION["privilege"] == 2) { ?>
          <input type="submit" name="addNews" class="addNews" value="add an Article">
        <?php } ?>
        <?php
        $data = $conn->prepare("SELECT `title`, `subtitle`, `text`, `date`, `ID` FROM `_dmp_news` ORDER BY `datetime` DESC");
        $data->execute();
        foreach ($data as $news) {
          $newsID = $news["ID"];
          echo "<div class='eachNews'>";
          echo "<h2>".$news['title']."</h2>";
          echo "<h4>".$news['date']." - ".$news['subtitle']."</h4>";
          echo "<p>".$news['text']."</p>";
          if ($_SESSION["privilege"] == 2) {
            echo "<a href='by_deleteNews.php?ID=$newsID'><button type='button' class='deleteNews'>delete</button></a>";}
            echo "</div>";
          }
          ?>
        </div>
        <?php
      }
      else {
        ?>
        <div class='divNews'>
          <label for="Title" class="titleText">Title</label>
          <input type="text" name="title" class="title" placeholder="Write a catchy title..">
          <label for="Subtitle" class="subtitleText">Subtitle</label>
          <input type="text" name="subtitle" class="subtitle" placeholder="Write an interesting subtitle..">
          <label for="text" class="textText">Article</label>
          <textarea name="text" rows="8" cols="80" class="text" placeholder="Write your desired article.."></textarea>
          <input type="submit" name="addMyWork" value="Submit my work" class="addMyWork">
        </div>
        <?php
      }
      if(isset($_SESSION["forename"]) AND ($_SESSION["forename"] == "" OR $_SESSION["surname"] == "")){
        ?>
        <div class="noname">
        </div>
        <div class="sqr">
          <h2 style="font-weight: bolder; text-decoration: underline; text-align:center; font-size: 50px; font-family: Courier, monospace;">Welcome!</h2>
          <p style="font-weight: bolder; text-align:center; font-size: 20px; font-family: Courier, monospace;">Thank you for registering to our website! Hope you'll enjoy it here for the time being! First, Type your name and surname here*:</p>
          <table>
            <tr>
              <th><label for="newforename" style="font-weight: bolder; font-size: 20px; font-family: Courier, monospace;">Forename</label></th>
              <td><input type="text" name="newfore" id="newforename" value="<?php echo $_SESSION["forename"]; ?>" class="foreandsur" required></td>
            </tr>
            <tr>
              <th><label for="newforename" style="font-weight: bolder; font-size: 20px; font-family: Courier, monospace;">Surname</label></th>
              <td><input type="text" name="newsur" id="newforename" value="<?php echo $_SESSION["surname"]; ?>" class="foreandsur" required></td>
            </tr>
            <tr>
              <td></td>
              <td><input type="submit" name="submitfore" class="submitfore" value="Continue"></td>
            </tr>
            <tr>
              <td></td>
              <td> <p>*We will use this information for distinguishing purposes and for a shortcut in the top right corner of the screen.</p> </td>
            </tr>
          </table>
        </div>
        <?php } ?>
    </form>
  </body>
  </html>
