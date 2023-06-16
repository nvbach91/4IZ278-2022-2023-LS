<?php
session_start();
include_once("by_detection.php");
include_once("by_database.php");
include('zpaypal_config.php');
$_SESSION['EXPRESS_MARK'] = NULL;
if (!isset($_SESSION["user"])){
  header("Location: main_login.php");
  exit();
}

if (!isset($_SESSION["user"])){
  header("Location: main_login.php");
  exit();
}
if($_POST["change_user"]){
  $data = $conn->prepare("UPDATE `_dmp_users` SET `username` = ? WHERE `mail` = ?");
  $data->execute([$_POST["change_username"], $_SESSION["mail"]]);
  header('Location: main_logout.php');
  exit();
}
if($_POST["submit"]){
  $data = $conn->prepare("UPDATE _dmp_users SET password = ? WHERE username = ?");
  $pass = password_hash($_POST["change_passowrd"], PASSWORD_DEFAULT);
  $data->execute([$pass, $_SESSION["user"]]);
  header('Location: main_logout.php');
  exit();
}
if($_POST["change_mail"]){
  $data = $conn->prepare("UPDATE `_dmp_users` SET `mail` = ? WHERE `username` = ?");
  $data->execute([$_POST["change_email"], $_SESSION["user"]]);
  $_SESSION["mail"] = $_POST["change_email"];
  header('Location: main_user.php');
  exit();
}
if($_POST["submit_birth"]){
  $date = $_POST['day']."/".$_POST['month']."/".$_POST['year'];
  $data = $conn->prepare("UPDATE `_dmp_users` SET `birth_date` = ? WHERE `username` = ?");
  $data->execute([$date, $_SESSION["user"]]);
  $_SESSION["birth_date"] = $date;
  header('Location: main_user.php');
  exit();
}
if($_POST["submit_colors"]){
  $data = $conn->prepare("UPDATE _dmp_users SET `primary` = ? , `secondary` = ? WHERE `username` = ?");
  $data->execute([$_POST["primary"],$_POST["secondary"] ,$_SESSION["user"]]);
  $_SESSION["primary"] = $_POST["primary"];
  $_SESSION["secondary"] = $_POST["secondary"];
  header('Location: main_user.php');
}
if($_POST["reset_color"]){
  $primary = "#adbf39";
  $secondary = "#ff9d57";
  $data = $conn->prepare("UPDATE `_dmp_users` SET `primary` = ? , `secondary` = ? WHERE `username` = ?");
  $data->execute([$primary, $secondary ,$_SESSION["user"]]);
  $_SESSION["primary"] = "#adbf39";
  $_SESSION["secondary"] = "#ff9d57";
  header('Location: main_user.php');
}
if($_POST["change_gender"]){
  $data = $conn->prepare("UPDATE `_dmp_users` SET `gender` = ? WHERE `username` = ?");
  $data->execute([$_POST["gender"], $_SESSION["user"]]);
  $_SESSION["gender"] = $_POST["gender"];
  header('Location: main_user.php');
  exit();
}
if($_POST["change_forename"]){
  $data = $conn->prepare("UPDATE `_dmp_users` SET `forename` = ? WHERE `username` = ?");
  $data->execute([$_POST["forename"], $_SESSION["user"]]);
  $_SESSION["forename"] = $_POST["forename"];
  if ($_POST["forename"] == ''){
  header('Location: main_news.php');
  }else{
      header('Location: main_user.php');
  }
  exit();
}
if($_POST["change_surname"]){
  $data = $conn->prepare("UPDATE `_dmp_users` SET `surname` = ? WHERE `username` = ?");
  $data->execute([$_POST["surname"], $_SESSION["user"]]);
  $_SESSION["surname"] = $_POST["surname"];
    if ($_POST["surname"] == ''){
  header('Location: main_news.php');
  }else{
      header('Location: main_user.php');
  }
  exit();
}
if($_POST["change_confirmed"]){
  if(isset($_POST["confirmed"])){
    $data = $conn->prepare("UPDATE `_dmp_users` SET `confirmed` = '1' WHERE `username` = ?");
    $data->execute([$_SESSION["user"]]);
    header('Location: main_logout.php');
    exit();
  }
  if(!isset($_POST["confirmed"])){
    $data = $conn->prepare("UPDATE `_dmp_users` SET `confirmed` = '0' WHERE `username` = ?");
    $data->execute([$_SESSION["user"]]);
    header('Location: main_logout.php');
    exit();
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DwGym - Account</title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="stylesheet" href="css/user.css">
  <link rel="icon" href="" type="image/x-icon"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="icon" href="" type="image/x-icon"/>
  <style type="text/css">
  <?php
  echo (":root{  --primary: ".$_SESSION["primary"]."; --secondary: ".$_SESSION["secondary"].";}");
  ?>
  </style>
  <?php
  include_once('main_header_style.php');
  ?>
</head>
<body>
  <?php include_once('main_header.php'); ?>
  <form method="post">
    <div class = "news">
      <table class="edits">
        <tr>
          <td id="header">Account settings</td>
          <td id="info">Given Info</td>
        </tr>
        <tr>
          <td><div class="newPass">Pay a 1-month permanent card</div></td>
          <td class="td" style="  text-align: center;
          font-size: large;
          color: black;
          border-bottom: 1px solid grey;
          font-weight: bold;"><?php   if ($_SESSION["wallet"] == '1')
          {
            echo $_SESSION["paypal_date"];
          }
          else{
            echo 'NOT PAID';
          }
          ?></td>
        </tr>
        <tr>
          <td class="borderline"></td>
          <td class="borderline"><form class="form" action="zpaypal_ec_redirect.php" method="POST"><input type="hidden" name="LOGOIMG" value=<?php echo('http://'.$_SERVER['HTTP_HOST'].preg_replace('/index.php/','img/logo.jpg',$_SERVER['SCRIPT_NAME'])); ?>/><div id="paymentMethods"></div></form></td>
        </tr>
        <tr>
          <td><div class="newPass">Edit Username</div></td>
          <td class="td" style="  text-align: center;
          font-size: large;
          color: black;
          border-bottom: 1px solid grey;
          font-weight: bold;"><?php echo $_SESSION["user"]; ?></td>
        </tr>
        <tr>
          <td class="borderline"><input type="text" name="change_username" class="newPassSubmit" value="<?php echo $_SESSION["user"]; ?>"></td>
          <td class="borderline"><input type="Submit" name="change_user" value="Change" class="submit_barva"></td>
        </tr>
        <tr>
          <td><div class="newPass">Edit Password</div></td>
          <td class="borderline">---</td>
        </tr>
        <tr>
          <td class="borderline"><input type="password" name="change_passowrd" class="newPassSubmit" placeholder="Password.." ></td>
          <td  class="borderline"><input type="Submit" name="submit" value="Change" class="submit_barva"></td>
        </tr>
        <tr>
          <td><div class="newPass">Edit E-mail</div></td>
          <td class="td" style="  text-align: center;
          font-size: large;
          color: black;
          border-bottom: 1px solid grey;
          font-weight: bold;"><?php echo $_SESSION["mail"]; ?></td>
        </tr>
        <tr>
          <td class="borderline"><input type="email" name="change_email" class="newPassSubmit" value="<?php echo $_SESSION["mail"]; ?>"></td>
          <td  class="borderline"><input type="Submit" name="change_mail" value="Change" class="submit_barva"></td>
        </tr>
        <tr>
          <td><div class="newPass">Edit Primary and Secondary color</div></td>
          <td class="td"><input type="Submit" name="reset_color" value="Reset" class="reset_color"></td>
        </tr>
        <tr>
          <td class="borderline"> <input type="color" name="primary" class="primary" value="<?php echo $_SESSION["primary"] ?>">
            <input type="color" name="secondary" class="primary" value="<?php echo $_SESSION["secondary"] ?>"></td>
            <td class="borderline"><input type="Submit" name="submit_colors" value="Change" class="submit_barva"></td>
          </tr>
          <tr>
            <td><div class="newPass">Edit birth date</div></td>
            <td class="borderline" style="  text-align: center;
            font-size: large;
            color: black;
            border-bottom: 1px solid grey;
            font-weight: bold;"><?php if ($_SESSION["birth_date"] != '') {
              echo $_SESSION["birth_date"];
            }
            else {
              echo "not set";
            }?></td>
          </tr>
          <tr>
            <td class="borderline">

              <label for="birth_date">Day:</label>
              <select name="day" id="birth_date" size="number" class="reset_color">
                <?php for ($i=1; $i <= 31; $i++) {
                  echo "<option value=$i>$i</option>";
                } ?>
              </select>
              <label for="month">Month:</label>
              <select name="month" id="month" class="reset_color">
                <?php for ($i=01; $i <= 12; $i++) {
                  echo "<option id='birth_date' value=$i>$i</option>";
                } ?>
              </select>
              <label for="year">Year:</label>
              <select name="year" id="year" class="reset_color">
                <?php for ($i=1900; $i <= date("Y"); $i++) {
                  echo "<option id='birth_date' value=$i>$i</option>";
                } ?>
              </select>
            </td>
            <td  class="borderline"><input type="Submit" name="submit_birth" value="Change" class="submit_barva"></td>
          </tr>
          <tr>
            <td><div class="newPass">Edit Gender</div></td>
            <td class="td" style="  text-align: center;
            font-size: large;
            color: black;
            border-bottom: 1px solid grey;
            font-weight: bold;"><?php if ($_SESSION["gender"] != '') {
              echo $_SESSION["gender"];
            }
            else {
              echo "gender not given";
            } ?></td>
          </tr>
          <tr>
            <td class="borderline"><input type="radio" id="e" name="gender" value="male"> <label for="e" class="gender">Male</label>
              <input type="radio" id="f" name="gender" value="female"> <label for="f" class="gender">Female</label>
              <input type="radio" id="g" name="gender" value="other"> <label for="g" class="gender">Other</label></td>
              <td class="borderline"><input type="Submit" name="change_gender" value="Change" class="submit_barva"></td>
            </tr>
            <tr>
              <td><div class="newPass">Edit Forename</div></td>
              <td class="td" style="  text-align: center;
              font-size: large;
              color: black;
              border-bottom: 1px solid grey;
              font-weight: bold;"><?php if ($_SESSION["forename"] != '') {
                echo $_SESSION["forename"];
              }
              else {
                echo "not set";
              } ?></td>
            </tr>
            <tr>
              <td class="borderline"> <input type="text" name="forename" class="newPassSubmit" value="<?php echo $_SESSION["forename"]; ?>" ></td>
              <td class="borderline"><input type="Submit" name="change_forename" value="Change" class="submit_barva"></td>
            </tr>
            <tr>
              <td><div class="newPass">Edit Surname</div></td>
              <td class="td" style="  text-align: center;
              font-size: large;
              color: black;
              border-bottom: 1px solid grey;
              font-weight: bold;"><?php if ($_SESSION["surname"] != '') {
                echo $_SESSION["surname"];
              }
              else {
                echo "not set";
              }?></td>
            </tr>
            <tr>
              <td class="borderline"><input type="text" name="surname" class="newPassSubmit" value="<?php echo $_SESSION["surname"]; ?>"></td>
              <td class="borderline"><input type="Submit" name="change_surname" value="Change" class="submit_barva"></td>
            </tr>
            <tr>
              <td><div class="newPass">Switch preferences</div></td>
              <td class="td" style="  text-align: center;
              font-size: large;
              color: black;
              border-bottom: 1px solid grey;
              font-weight: bold;"><?php if ($_SESSION["confirmed"] == '1') {
                echo "agreed";
              }
              if ($_SESSION["confirmed"] == '0')  {
                echo "disagreed";
              } ?></td>
            </tr>
            <tr>
              <td class="borderline">
                <?php if ($_SESSION["confirmed"] == '1') {
                  echo '<input type="checkbox" id="confirmed" name="confirmed" value="1" checked>';
                }  else {
                  echo '<input type="checkbox" id="confirmed" name="confirmed" value="0">';
                }  ?>
                <label for="confirmed">I agree with the processing of my personal data for analytical purposes and sending business messages</label>
              </td>
              <td class="borderline"><input type="Submit" name="change_confirmed" value="Change" class="submit_barva"></td>
            </tr>
            <?php if ($_SESSION["privilege"] >= '2') { ?>
              <tr>
                <td><div class="newPass">List of users</div></td>
                <td><input type='button'value='Users' onclick="location.href='main_participants.php';"></td>
              </tr>
            <?php } ?>
          </table>

        </div>
      </form>
      <script src="//www.paypalobjects.com/api/checkout.js" ></script>
      <script type="text/javascript">
      function getRandomNumberInRange(min, max) {
        return Math.floor(Math.random() * (max - min) + min);
      }


      var buyerCredentials = [{"email":"ron@hogwarts.com", "password":"qwer1234"},
      {"email":"sallyjones1234@gmail.com", "password":"p@ssword1234"},
      {"email":"joe@boe.com", "password":"123456789"},
      {"email":"hermione@hogwarts.com", "password":"123456789"},
      {"email":"lunalovegood@hogwarts.com", "password":"123456789"},
      {"email":"ginnyweasley@hogwarts.com", "password":"123456789"},
      {"email":"bellaswan@awesome.com", "password":"qwer1234"},
      {"email":"edwardcullen@gmail.com", "password":"qwer1234"}];
      var randomBuyer = getRandomNumberInRange(0,buyerCredentials.length);

      document.getElementById("buyer_email").value =buyerCredentials[randomBuyer].email;
      document.getElementById("buyer_password").value =buyerCredentials[randomBuyer].password;


      </script>

      <script type="text/javascript">
      window.onload = function(){

        var CREATE_PAYMENT_URL  = './zpaypal_ec_redirect.php';
        var formdata = {PAYMENTREQUEST_0_AMT: '20' , paymentType:'SALE', PAYMENTREQUEST_0_CURRENCYCODE: 'EUR', currencyCodeType: 'EUR'};

        paypal.Button.render({

          env: 'sandbox',  // sandbox | production
          style: {
            size: 'small',   // tiny | small | medium
            color: 'gold',	// gold | blue | silver
            shape: 'rect',	// pill | rect
            label: 'checkout' // checkout | credit
          },
          payment: function(resolve) {
            jQuery.post(CREATE_PAYMENT_URL,formdata,function(data) {
              console.log("Displaying data here: " + data);
              resolve(data); // no data.token, b/c data.token is json format
            });
          },

          onAuthorize: function(data, actions) {

            var EXECUTE_PAYMENT_URL  = './zpaypal_ec_redirect.php';

            jQuery.post(EXECUTE_PAYMENT_URL,
              {payToken: data.paymentID, payerId: data.payerID},function(response) {
                // if successful navigate to success page
                // else
                if (response === '10486') {
                  actions.restart();

                }});
                return actions.redirect();

              },

              onCancel: function(data, actions) {
                return actions.redirect();
              }

            }, '#paymentMethods');
          }
          </script>


          <?php include('zpaypal_footer.php') ?>

        </body>
        </html>
