<?php
session_start();
include_once("by_database.php");
include_once("by_detection.php");
if ($_SESSION["privilege"] == 0){
  header("Location: main_news.php");
  exit();
}
$down = "";

if ($_SESSION["privilege"] >= '2' AND !isset($_GET["day"])) {
  $limit = 10;

$data = $conn->prepare("SELECT COUNT(*) as total FROM _dmp_users");
$data->execute([]);
foreach ($data as $countU) {

$total_products = $countU['total'];
$total_pages = ceil($total_products / $limit);


$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

        if ($page > 1) {
            echo "<a href='?page=" . ($page - 1) . "' class='pagination-link'>Previous</a> ";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo "<a href='?page=" . $i . "' class='pagination-link active'>" . $i . "</a> ";
            } else {
                echo "<a href='?page=" . $i . "' class='pagination-link'>" . $i . "</a> ";
            }
        }

        if ($page < $total_pages) {
            echo "<a href='?page=" . ($page + 1) . "' class='pagination-link'>Next</a>";
        }
     echo $limit;
     echo $offset;
     
  $data = $conn->prepare("
    SELECT `username`, `mail`, `birth_date`, `gender`, `privileges`, `forename`, `surname`, `confirmed`, `wallet`, `banned` FROM `_dmp_users` 
    WHERE `username` != ?
    ORDER BY `surname`
    LIMIT 10 OFFSET ?
  ");
  $data->bindValue(1, $_SESSION['user'], PDO::PARAM_STR);
  $data->bindValue(2, $offset, PDO::PARAM_INT);
//$data->bindParam(':username', $_SESSION['user'], PDO::PARAM_STR);
  $data->execute();
  $data = $data->fetchAll();
}
}
if ($_SESSION["privilege"] == '1' OR ($_SESSION["privilege"] >= '2' AND isset($_GET["day"]))) {
  $data = $conn->prepare("SELECT `mail`, `birth_date`, `gender`, `forename`, `surname` FROM `_dmp_users` JOIN `_dmp_booking` ON `_dmp_users`.`ID` = `_dmp_booking`.`_dmp_users_ID` WHERE `_dmp_booking`.`day` = ? AND `_dmp_booking`.`time` = ? AND `_dmp_booking`.`week` = ?  ORDER BY `surname` ASC");
  $data->execute([$_GET["day"], $_GET["time"], $_GET["week"]]);
}
if (isset($_GET["up"])) {
  $up = $conn->prepare("SELECT `privileges` FROM `_dmp_users` WHERE `username` = ?");
  $up->execute([$_GET["up"]]);
  foreach ($up as $privileges) {
    if ($privileges['privileges'] != '2') {
      $privileges['privileges'] = $privileges['privileges'] + 1;
      $up = $conn->prepare("UPDATE `_dmp_users` SET `privileges` = ? WHERE `username` = ?");
      $up->execute([$privileges['privileges'], $_GET["up"]]);
      header('Location:main_participants.php');
    }
  }
}
if (isset($_GET["down"])) {
  $down = $conn->prepare("SELECT `privileges` FROM `_dmp_users` WHERE `username` = ?");
  $down->execute([$_GET["down"]]);
  foreach ($down as $priv) {
    if ($priv['privileges'] != '0') {
      $priv['privileges'] = $priv['privileges'] - 1;
      $down = $conn->prepare("UPDATE `_dmp_users` SET `privileges` = ? WHERE `username` = ?");
      $down->execute([$priv['privileges'], $_GET["down"]]);
      header('Location:main_participants.php');
    }
  }
}

if (isset($_GET["ban"])) {
  $down = $conn->prepare("UPDATE `_dmp_users` SET `banned` = '1' WHERE `username` = ?");
  $down->execute([$_GET["ban"]]);
  header('Location:main_participants.php');
}
if (isset($_GET["unban"])) {
  $down = $conn->prepare("UPDATE `_dmp_users` SET `banned` = '0' WHERE `username` = ?");
  $down->execute([$_GET["unban"]]);
  header('Location:main_participants.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DwGym - Users</title>
  <link rel="stylesheet" href="css/user.css">
  <link rel="icon" href="" type="image/x-icon"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="icon" href="" type="image/x-icon"/>
  <?php
  include_once('main_header_style.php');
  ?>
  <style media="screen">
  .tdusers{
    border-bottom: 2px solid grey;
    border-left: 1px solid grey;
    font-size: large;
    text-align: center;
  }
  tr .iinfo{
    text-align: center;
    font-size: x-large;
    border-left: 1px solid grey;
    border-bottom: 5px solid grey;
  }
  .down{
    min-width: 30px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    padding: 0px!important;
    padding-left: 5px !important;
    padding-right: 5px !important;
    background: var(--secondary) !important;
    cursor: pointer;
    margin: 0px !important;
  }
  </style>
</head>
<body>
  <?php include_once('main_header.php'); ?>
  <form method="get">
    <div class = "participantss">
      <h1 style="text-decoration: underline; text-align:center;">Users</h1>
      <table class="edits">
        <tr>
          <?php if ($_SESSION["privilege"] >= '2' AND !isset($_GET["day"])) {?>
            <td class="iinfo">Username</td>
          <?php  } ?>
          <td class="iinfo">Forename</td>
          <td class="iinfo">Surname</td>

          <td class="iinfo">Email</td>
          <td class="iinfo">Birth</td>
          <td class="iinfo">Gender</td>
          <?php if ($_SESSION["privilege"] >= '2' AND !isset($_GET["day"])) {?>
            <td class="iinfo">Privileges</td>
            <td class="iinfo">Advertisement</td>
            <td class="iinfo">Subscriptions</td>
            <td class="iinfo" style="min-width: 100px;">Status</td>
            <td class="iinfo">Ban</td>
          <?php  } ?>

        </tr>
        <tr>
          <?php foreach ($data as $user) {
            if ($user['privileges'] == '0') {
              $privilege = 'registered';
            }
            if ($user['privileges'] == '1') {
              $privilege = 'trainer';
            }
            if ($user['privileges'] == '2') {
              $privilege = 'admin';
            }
            if ($user['privileges'] == '3') {
              $privilege = 'superAdmin';
            }

            if ($user['confirmed'] == '0') {
              $confirmed = 'not Confirmed';
            }
            if ($user['confirmed'] == '1') {
              $confirmed = 'Confirmed';
            }

            if ($user['wallet'] == '0') {
              $wallet = 'not Subscribed';
            }
            if ($user['wallet'] == '1') {
              $wallet = 'Subscribed';
            }
            if ($user['banned'] == '0') {
              $banned = 'not Banned';
            }
            if ($user['banned'] == '1') {
              $banned = 'Banned';
            }
            if ($_SESSION["privilege"] >= '2' AND !isset($_GET["day"])) {?>
              <td class="tdusers"><?php echo $user['username']; ?></td>
            <?php  } ?>
            <td class="tdusers"><?php echo $user['forename'];?></td>
            <td class="tdusers"><?php echo $user['surname']; ?></td>

            <td class="tdusers"><?php echo $user['mail']; ?></td>
            <td class="tdusers"><?php echo $user['birth_date']; ?></td>
            <td class="tdusers"><?php echo $user['gender']; ?></td>
            <?php if ($_SESSION["privilege"] >= '2' AND !isset($_GET["day"])) {?>
              <td class="tdusers" style="min-width:170px; text-align: left;">
                <button type="submit" name="up" class="down" value="<?php echo $user['username']; ?>"><i class='fas fa-chevron-up'></i></button>
                <button type="submit" name="down" class="down" value="<?php echo $user['username']; ?>"><i class='fas fa-chevron-down'></i></button>
                <?php echo $privilege; ?>
              </td>
              <td class="tdusers"><?php echo $confirmed; ?></td>
              <td class="tdusers"><?php echo $wallet; ?></td>
              <td class="tdusers"><?php echo $banned; ?></td>
              <td class="tdusers" style="">
                <?php if ($user['banned'] == '0') { ?>
                  <button type="submit" name="ban" class="down" value="<?php echo $user['username']; ?>"><i class="fas fa-ban"></i></button>

                <?php }
                else {
                  ?><button type="submit" name="unban" class="down" value="<?php echo $user['username']; ?>"><i class="fas fa-arrow-up"></i></button><?php
                } ?>
              </td>
            <?php  } ?>
          </tr>
        <?php } ?>
      </table>
    </div>
  </form>
</body>
</html>
