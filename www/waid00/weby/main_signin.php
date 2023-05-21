<?php
session_start();
include_once("by_detection.php");
include_once("by_database.php");
if (isset($_POST['t1'])){
  $date = $_POST['day']."/".$_POST['month']."/".$_POST['year'];
  $data = $conn->prepare("SELECT COUNT(username) AS `user` FROM `_dmp_users` WHERE `username` = ?");
  $data->execute([$_POST['name']]);
  foreach ($data as $name) {
    if ($name['user'] == '1') {
      $nameerr = true;
    }
    $data = $conn->prepare("SELECT COUNT(mail) AS `mail` FROM `_dmp_users` WHERE `mail` = ?");
    $data->execute([$_POST['mail']]);
    foreach ($data as $mail) {
      if ($mail['mail'] == '1') {
        $mailerr = true;
      }
      if ($mailerr == false AND $nameerr == false) {
        if (isset($_POST['gender'])) {
          if ($_POST["pass"] === $_POST["pass_again"]) {
            if (isset($_POST['confirmed'])) {
              header('Location: main_login.php');
              $a = password_hash($_POST["pass"], PASSWORD_DEFAULT);
              $q = $conn->prepare("INSERT INTO `_dmp_users` (`ID`, `username`, `mail`, `birth_date`, `gender`, `privileges`, `password`, `forename`, `surname`, `primary`, `secondary`, `confirmed`) VALUES (NULL, ?, ?, ?, ?, '0', ?, '', '', '#adbf39', '#ffb37b', '1')");
              $q->execute([$_POST['name'], $_POST['mail'],$date, $_POST['gender'], $a]);
            }
            else {
              header('Location: main_login.php');
              $a = password_hash($_POST["pass"], PASSWORD_DEFAULT);
              $q = $conn->prepare("INSERT INTO `_dmp_users` (`ID`, `username`, `mail`, `birth_date`, `gender`, `privileges`, `password`, `forename`, `surname`, `primary`, `secondary`) VALUES (NULL, ?, ?, ?, ?, '0', ?, '', '', '#adbf39', '#ffb37b')");
              $q->execute([$_POST['name'], $_POST['mail'], $date, $_POST['gender'], $a]);
            }
          }
          else {
            $err = true;
          }
        }
        else {
          $gendererr = true;
        }
      }
    }
  }
}
?>
<!doctype html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>DwGym - Sign in</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="icon" href="icon/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="css/login.css">
</head>
<body style="overflow:hidden;">
  <main>
    <div class="row">
      <?php include('by_pages_LogSign.html'); ?>
      <div class="col">
        <div class="rrightside">
          <div class="registration">
            <div class="form-body">
              <h1 class="title">Sign in</h1>
              <form method="post" class="the-form" autocomplete="off">

                <label for="text">Username*</label>
                <input type="text" id="a" name="name" step="any" required>

                <label for="text">E-mail*</label>
                <input type="email" id="b" name="mail" step="any" required>

                <label for="text">Birth date*</label>
                <div>
                  <label for="day">Day:</label>
                  <select name="day" id="birth_date" size="number">
                    <?php for ($i=1; $i <= 31; $i++) {
                      echo "<option value=$i>$i</option>";
                    } ?>
                  </select>
                  <label for="month">Month:</label>
                  <select name="month" id="birth_date">
                    <?php for ($i=01; $i <= 12; $i++) {
                      echo "<option id='birth_date' value=$i>$i</option>";
                    } ?>
                  </select>
                  <label for="year">Year:</label>
                  <select name="year" id="birth_date">
                    <?php for ($i=1900; $i <= date("Y"); $i++) {
                      echo "<option id='birth_date' value=$i>$i</option>";
                    } ?>
                  </select>
                </div>
                <label for="text">Password*</label>
                <input type="password" id="c" name="pass" step="any" required>
                <label for="text">Re-enter password*</label>
                <input type="password" id="d" name="pass_again" step="any" required>
                <div class="container">
                  <label for="x">Gender</label>
                  <input type="radio" id="e" name="gender" value="male"> <label for="e">Male</label>
                  <input type="radio" id="f" name="gender" value="female"> <label for="f">Female</label>
                  <input type="radio" id="g" name="gender" value="other"> <label for="g">Other</label>
                </div>
                <div class="container">
                  <input type="checkbox" id="confirmed" name="confirmed" value="1">  <label for="confirmed">I agree with the processing of my personal data for analytical purposes and with sending business messages to my e-mail (change is stil possible after registration) </label>
                </div>

                <input type="Submit" name="t1" class="submit" value="Sign in">
              </form>
              <?php if ($err == true){
                echo "Your password did not match.<br>";
              }
              if ($gendererr == true){
                echo "Please, enter your gender.<br>";
              }
              if ($nameerr == true){
                echo "This username is already taken.<br>";
              }
              if ($mailerr == true){
                echo "This e-mail is already taken.<br>";
              }
              ?>
              <div class="form-footer">
                <div class="already">
                  <span>Already have an account?</span> <a href="main_login.php">Log in</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
