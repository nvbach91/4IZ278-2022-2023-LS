<?php
session_start();
include_once("by_detection.php");
$err = false;
if(isset($_POST['submit'])){
  include_once("by_database.php");
  $data = $conn->prepare("SELECT `password`, `privileges`, `mail`, `primary`,`secondary`, `forename`, `surname`, `gender`, `confirmed`, `wallet`, `ID`, `paypal_date`, `banned`, `birth_date` FROM `_dmp_users` WHERE `username` = ?");
  $data->execute([$_POST['username']]);
  $user = $data->fetch();
  if ($user['banned'] != '1') {
    if (password_verify($_POST['password'], $user['password'])){
      $_SESSION['user'] = $_POST['username'];
      $_SESSION["privilege"] = $user['privileges'];
      $_SESSION["mail"] = $user['mail'];
      $_SESSION["primary"] = $user["primary"];
      $_SESSION["secondary"] = $user["secondary"];
      $_SESSION["forename"] = $user["forename"];
      $_SESSION["surname"] = $user["surname"];
      $_SESSION["gender"] = $user["gender"];
      $_SESSION["confirmed"] = $user["confirmed"];
      $_SESSION["wallet"] = $user["wallet"];
      $_SESSION["iduser"] = $user["ID"];
      $_SESSION["birth_date"] = $user["birth_date"];
      $_SESSION["paypal_date"] = $user["paypal_date"];
      header('Location: main_news.php');
      exit();
    }
    else {
      $err = true;
    }
  }

  if ($user['banned'] == '1') {
    $banned = true;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DwGym - login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/login.css">
  <link rel="icon" href="icon/favicon.ico" type="image/x-icon"/>
</head>
<body style="overflow:hidden;">
  <main>
    <div class="row">
      <?php include('by_pages_LogSign.html'); ?>
      <div class="col">
        <div class="rightside">
          <div class="login">
            <div class="form-body">
              <h1 class="title">Log in</h1>
              <form method="post" class="the-form" autocomplete="off">
                <label for="text">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username...">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password...">
                <input type="submit" name="submit" value="Log in" class="submit">
                <?php if ($err == true){
                  echo ("<h5>Invalid username or password.</h5>");
                }
                if ($banned == true){
                  echo ("<h5>Your account has been banned.</h5>");
                }
                ?>
                <div class="form-footer">
                  <div class="register">
                    <span>Don't have an account?</span> <a href="main_signin.php">Sign Up</a>
                  </div>
                </div>
              </form>

            </div>

          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
