<?php

session_start();
include_once("by_detection.php");
include_once("by_database.php");
if (isset($_GET['edit_booking'])){
  $_SESSION['edit_booking'] = '1';
}
if (isset($_GET['back_edit'])){
  unset($_SESSION['edit_booking']);
}
if (isset($_GET['deleteitLesson'])){
  $data = $conn->prepare("DELETE FROM `_dmp_booking_lessons` WHERE `name` = ? LIMIT 1");
  $data->execute([$_GET['delLessonText']]);
}


if (isset($_GET['edititLesson'])){
  $data = $conn->prepare("UPDATE `_dmp_booking_lessons` SET `name` = ? WHERE `ID` = ?");
  $data->execute([$_GET['editlessonText'], $_GET['edititLessonText']]);
}
$week = '0';
//$now = getdate();
//$x = 5 - (5 + 2) % 7;
//$rere = mktime(0, 0, 0, $now['mon'], $x);
//echo(date('d/m', $rere));
//$mday_fri_1 = $now['mday'] - ($now['wday'] + 2) % 7;
//echo($mday_fri_1);
//$friday1 = mktime(0, 0, 0, $now['mon'], $mday_fri_1, $now['year']);
//echo(date('d/m/y', $friday1));

$today = time();
$wday = date('w', $today);
if ($wday == 0) {
  $datemon1 = date('d.m.Y', $today - ($wday + 6)*86400);
  $datetue1 = date('d.m.Y', $today - ($wday + 5)*86400);
  $datewed1 = date('d.m.Y', $today - ($wday + 4)*86400);
  $datethu1 = date('d.m.Y', $today - ($wday + 3)*86400);
  $datefri1 = date('d.m.Y', $today - ($wday + 2)*86400);
  $datesat1 = date('d.m.Y', $today - ($wday + 1)*86400);
  $datesun1 = date('d.m.Y', $today - ($wday + 0)*86400);

  $datemond1 = date('d.m.', $today - ($wday + 6)*86400);
  $datesund1 = date('d.m.', $today - ($wday + 0)*86400);
  $datemond2 = date('d.m.', $today - ($wday - 1)*86400);
  $datesund2 = date('d.m.', $today - ($wday - 7)*86400);

  $datemon2 = date('d.m.Y', $today - ($wday - 1)*86400);
  $datetue2 = date('d.m.Y', $today - ($wday - 2)*86400);
  $datewed2 = date('d.m.Y', $today - ($wday - 3)*86400);
  $datethu2 = date('d.m.Y', $today - ($wday - 4)*86400);
  $datefri2 = date('d.m.Y', $today - ($wday - 5)*86400);
  $datesat2 = date('d.m.Y', $today - ($wday - 6)*86400);
  $datesun2 = date('d.m.Y', $today - ($wday - 7)*86400);
}
else {
  $datemon1 = date('d.m.Y', $today - ($wday - 1)*86400);
  $datetue1 = date('d.m.Y', $today - ($wday - 2)*86400);
  $datewed1 = date('d.m.Y', $today - ($wday - 3)*86400);
  $datethu1 = date('d.m.Y', $today - ($wday - 4)*86400);
  $datefri1 = date('d.m.Y', $today - ($wday - 5)*86400);
  $datesat1 = date('d.m.Y', $today - ($wday - 6)*86400);
  $datesun1 = date('d.m.Y', $today - ($wday - 7)*86400);

  $datemond1 = date('d.m.', $today - ($wday - 1)*86400);
  $datesund1 = date('d.m.', $today - ($wday - 7)*86400);
  $datemond2 = date('d.m.', $today - ($wday - 8)*86400);
  $datesund2 = date('d.m.', $today - ($wday - 14)*86400);

  $datemon2 = date('d.m.Y', $today - ($wday - 8)*86400);
  $datetue2 = date('d.m.Y', $today - ($wday - 9)*86400);
  $datewed2 = date('d.m.Y', $today - ($wday - 10)*86400);
  $datethu2 = date('d.m.Y', $today - ($wday - 11)*86400);
  $datefri2 = date('d.m.Y', $today - ($wday - 12)*86400);
  $datesat2 = date('d.m.Y', $today - ($wday - 13)*86400);
  $datesun2 = date('d.m.Y', $today - ($wday - 14)*86400);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>DwGym - Timetable</title>
  <meta name="robots" content="index, follow">
  <meta name="description" content="Reserve a lesson here for ultimate experience! It has a great variety so come on in!">
  <link rel="stylesheet" href="css/booking.css">
  <?php
  include('main_header_style.php');
  ?>
  <style type="text/css">
  <?php
  if ($full == '1'){
    echo (":root{  --full: #C14E4E;}");
  }
  ?>
  </style>
</head>
<body>
  <?php include_once('main_header.php'); ?>
  <form method="get">
    <br><br><br><br><br>
    <h1 style="text-decoration: underline; padding: 10px; padding-left: 25px; padding-bottom: 0px; font-size: 28px;">Timetable (<?php echo $datemond1.' - '.$datesund1; ?>)</h1>
    <?php if (isset($_SESSION["privilege"])) { ?>
      <input type="button" name="nextWeek" value="Next week (<?php echo $datemond2.' - '.$datesund2; ?>)" class="addRow" style="background-color: var(--primary); margin-bottom:20px; margin-top:10px;" onclick="window.location.href = 'main_booking_next.php';"><br>
    <?php } if ($_SESSION["privilege"] == 2) {
      ?> <input type="submit" name="edit_booking" value="Adjustments" class="addit" id="edit_booking">  <?php
    }?>
    <div class="table_res">
      <?php
      $table=0;
      while ($table <= 7) {
        $sql = "SELECT `ID`, `name`, `day`, `max`, `time`, `trainer`, `_dmp_booking_lessons_ID` FROM `_dmp_booking_cells` WHERE `day` = $table ORDER BY `day`,`time` ASC";
        $data = $conn->query($sql);
        $vysledek = $data->fetchAll();
        echo "<table>
        <thead>
        <tr>";
        if ($table == 0) {
          echo "<th>Time</th>
          </tr>
          ";
        }
        if ($table == 1) {
          echo "<th>Mon ".$datemon1."</th>
          </tr>
          ";
        }
        if ($table == 2) {
          echo "<th>Tue ".$datetue1."</th>
          </tr>
          ";
        }
        if ($table == 3) {
          echo "<th>Wed ".$datewed1."</th>
          </tr>
          ";
        }
        if ($table == 4) {
          echo "<th>Thu ".$datethu1."</th>
          </tr>
          ";
        }
        if ($table == 5) {
          echo "<th>Fri ".$datefri1."</th>
          </tr>
          ";
        }
        if ($table == 6) {
          echo "<th>Sat ".$datesat1."</th>
          </tr>
          ";
        }
        if ($table == 7) {
          echo "<th>Sun ".$datesun1."</th>
          </tr>
          ";
        }
        echo "</thead>";
        echo "<tbody>";
        foreach ($vysledek as $row) {
          $day = $row['day'];
          $time = $row['time'];
          echo "<tr>";
          if ($row['day'] == 0) {
            echo "<td>";
            echo $row['time'];
            echo "</td>";
            if ($_SESSION["privilege"] == 2) {
              echo "<td class='add_cut'><div class='delete'>";
              $data = $conn->prepare("SELECT `name` FROM `_dmp_booking_cells` WHERE `time` = ? AND (`name` = '' OR `name` = '0' OR `name` IS NULL)");
              $data->execute([$row['time']]);
              $countEmpty = $data->rowCount();

              if ($countEmpty == 7) {
                echo "<a href=by_deleteRow.php?time=$time><input type='button' class='add_delete_participants' value='delRow'></a>";
              }
              echo "</div></td>";
            }
            echo "</tr>";

          }
          elseif ($row['name'] == "") {
            echo "<td></td>";
            if ($_SESSION["privilege"] == 2) {
              echo "<td class='add_cut'><a href=by_addCell.php?day=$day&time=$time><input type='button' class='add_delete_participants_add' value='add'></a></td>";
            }
            if ($_SESSION["privilege"] == 1) {
              echo "<td class='add_cut_trainer'></td>";
            }
            echo "</tr>";
          }
          else {
            $sql = "SELECT COUNT(ID) AS 'pocet' FROM `_dmp_booking` WHERE `time` = ? AND `day` = $day AND `week` = '0'";
            $data = $conn->prepare($sql);
            $data->execute([$row['time']]);
            foreach ($data as $pocet) {
              if ( $pocet['pocet'] == $row['max']) {
                      if (!isset($_SESSION["email"])) {
                      
                      $sql = "SELECT `username` FROM `_dmp_booking` WHERE `time` = ? AND `day` = $day AND `username` = ? AND `week` = '0'";
                      $data = $conn->prepare($sql);
                      $data->execute([$row['time'], $_SESSION["user"]]);
                      }
                      else{
                      $sql = "SELECT `oauth` FROM `_dmp_booking` WHERE `time` = ? AND `day` = $day AND `oauth` = ? AND `week` = '0'";
                      $data = $conn->prepare($sql);
                      $data->execute([$row['time'], $_SESSION["email"]]);
                      }
                $countUser = $data->rowCount();
                if ($countUser == 1) {
                  echo "<td class='reserved'>";
                }
                else {
                  echo "<td class='error'>";
                }

              }
              if ( $pocet['pocet'] != $row['max']) {
                      if (!isset($_SESSION["email"])) {
                      
                      $sql = "SELECT `username` FROM `_dmp_booking` WHERE `time` = ? AND `day` = $day AND `username` = ? AND `week` = '0'";
                      $data = $conn->prepare($sql);
                      $data->execute([$row['time'], $_SESSION["user"]]);
                      }
                      else{
                      $sql = "SELECT `oauth` FROM `_dmp_booking` WHERE `time` = ? AND `day` = $day AND `oauth` = ? AND `week` = '0'";
                      $data = $conn->prepare($sql);
                      $data->execute([$row['time'], $_SESSION["email"]]);
                      }
                $countUser = $data->rowCount();
                if ($countUser == 1) {
                  echo "<td class='reserved'>";
                }}
                if ($countUser != 1 AND $pocet['pocet'] != $row['max']) {
                  echo "<td class='open'>";
                }
              }
              if ($table == 0) {
                echo $row['day'];

              }
              else {
                $sql = "SELECT `_dmp_booking_lessons`.`name` AS `lesson` FROM `_dmp_booking_lessons` LEFT JOIN `_dmp_booking_cells` ON `_dmp_booking_lessons`.`ID` = `_dmp_booking_cells`.`_dmp_booking_lessons_ID` WHERE `day` = $day AND `time` = '$time'";
                $data = $conn->prepare($sql);
                $data->execute([$row['day'], $row['time']]);
                foreach ($data as $lesson) {
                  echo $lesson['lesson'];
                }
                echo " ";
                $sql = "SELECT COUNT(ID) AS 'pocet' FROM `_dmp_booking` WHERE `time` = ? AND `day` = $day AND `week` = '0'";
                $data = $conn->prepare($sql);
                $data->execute([$row['time']]);
                foreach ($data as $pocet) {
                  if (isset($_SESSION["user"]) OR isset($_SESSION["email"])){
                    echo $pocet['pocet'];

                    echo "/";
                    echo $row['max'];
                    echo "<br>";
                    $sql = "SELECT `forename`, `surname` FROM `_dmp_users` LEFT JOIN `_dmp_booking_cells` ON `_dmp_booking_cells`.`_dmp_users_ID` = `_dmp_users`.`ID` WHERE `time` = '$time' AND `day` = $day";
                    $data = $conn->prepare($sql);
                    $data->execute();
                    foreach ($data as $value) {
                      echo $value['forename'].' '.$value['surname'];
                    }
                    echo "<br>";


                    if ($pocet['pocet'] < $row['max']) {
                      $_SESSION['full'] = '0';
                      if (!isset($_SESSION["email"])) {
                      
                      $sql = "SELECT `username` FROM `_dmp_booking` WHERE `time` = ? AND `day` = $day AND `username` = ? AND `week` = '0'";
                      $data = $conn->prepare($sql);
                      $data->execute([$row['time'], $_SESSION["user"]]);
                      }
                      else{
                      $sql = "SELECT `oauth` FROM `_dmp_booking` WHERE `time` = ? AND `day` = $day AND `oauth` = ? AND `week` = '0'";
                      $data = $conn->prepare($sql);
                      $data->execute([$row['time'], $_SESSION["email"]]);
                      }
                      $countUser = $data->rowCount();
                      if ($countUser < 1) {
                        echo "<a href=by_book.php?day=$day&time=$time&week=$week><input type='button' class='add_delete_participants_reserve' value='Reserve'></a><br>";
                      }
                      else{
                        echo "<a href=by_unBook.php?day=$day&time=$time&week=$week><input type='button' class='add_delete_participants_reserve' value='unReserve'></a><br>";
                      }
                    }
                    if ($pocet['pocet'] == $row['max']) {
                      if (!isset($_SESSION["email"])) {
                      
                      $sql = "SELECT `username` FROM `_dmp_booking` WHERE `time` = ? AND `day` = $day AND `username` = ? AND `week` = '0'";
                      $data = $conn->prepare($sql);
                      $data->execute([$row['time'], $_SESSION["user"]]);
                      }
                      else{
                      $sql = "SELECT `oauth` FROM `_dmp_booking` WHERE `time` = ? AND `day` = $day AND `oauth` = ? AND `week` = '0'";
                      $data = $conn->prepare($sql);
                      $data->execute([$row['time'], $_SESSION["email"]]);
                      }
                      $countUser = $data->rowCount();
                      if ($countUser == 1) {
                        echo "<a href=by_unBook.php?day=$day&time=$time&week=$week><input type='button' class='add_delete_participants_reserve' value='unReserve'></a><br>";
                      }
                    }
                  }
                  else {
                    echo "<br>";
                    $sql = "SELECT `forename`, `surname` FROM `_dmp_users` LEFT JOIN `_dmp_booking_cells` ON `_dmp_booking_cells`.`_dmp_users_ID` = `_dmp_users`.`ID` WHERE `time` = '$time' AND `day` = $day";
                    $data = $conn->prepare($sql);
                    $data->execute();
                    foreach ($data as $value) {
                      echo ['forename'].' '.$value['surname'];
                    }
                  }
                  echo "</td>";
                  $trainer = $_SESSION['forename']." ".$_SESSION['surname'];
                  $sql = "SELECT `forename`, `surname` FROM `_dmp_users` LEFT JOIN `_dmp_booking_cells` ON `_dmp_booking_cells`.`_dmp_users_ID` = `_dmp_users`.`ID` WHERE `time` = '$time' AND `day` = $day";
                  $data = $conn->prepare($sql);
                  $data->execute();
                  foreach ($data as $value) {
                    $trainer2 = $value['forename'].' '.$value['surname'];
                  if ($trainer == $trainer2  OR $_SESSION["privilege"] > 1) {
                    if ($_SESSION["privilege"] == 2) {
                      echo "<td class='add_cut'><a href=by_deleteCell.php?day=$day&time=$time><input type='button' class='add_delete_participants_participants' value='delCell'></a><br>
                      <a href=main_participants.php?day=$day&time=$time&week=$week><input type='button' class='add_delete_participants_participants' value='list'></a></td>";
                    }

                    if ($trainer == $trainer2 AND ($_SESSION["privilege"] != 2 AND $_SESSION["privilege"] != 3 AND $_SESSION["privilege"] != 0)) {

                      echo "<td class='add_cut'><a href=main_participants.php?day=$day&time=$time&week=$week><input type='button' class='add_delete_participants_participants' value='list'></a></td>";
                    }
                  }
                  if ($trainer != $trainer2 AND ($_SESSION["privilege"] != 2 AND $_SESSION["privilege"] != 3 AND $_SESSION["privilege"] != 0)) {

                    echo "<td class='add_cut_trainer'></td>";
                  }
                  echo "</tr>";
                }}
              }
            }
          }
          $table++;
        }

        ?>
      </div>
    </tbody>
  </table>
</div>

<?php if ($_SESSION["privilege"] == 2) {

  if (isset($_GET['addIt'])){
    $data = $conn->prepare("SELECT `name` FROM `_dmp_booking_cells` WHERE `name` = ?");
    $data->execute([$_GET['addTime']]);
    $countTime = $data->rowCount();
    if ($countTime >= 1) {
$already = true;
    }
    else {
      $data = $conn->prepare("INSERT INTO `_dmp_booking_cells` (`ID`,`name`, `day`, `max`, `time`, `_dmp_users_ID`, `_dmp_booking_lessons_ID`) VALUES (NULL, ?, '0', '', ?, '0','0')");
      $data->execute([$_GET['addTime'], $_GET['addTime']]);
      $checkDay = 1;
      $addTime = $_GET['addTime'];
      while ($checkDay <= 7) {
        $sql = "INSERT INTO `_dmp_booking_cells` (`ID`,`name`, `day`, `max`, `time`, `_dmp_users_ID`, `_dmp_booking_lessons_ID`) VALUES (NULL, '', '$checkDay', '', '$addTime', '0','0')";
        $data = $conn->prepare($sql);
        $data->execute([$_GET['addTime']]);
        $checkDay++;
      }
      echo "<script>window.location.href='main_booking.php';</script>";
    }
  }
  ?>
  <?php
  if (isset($_GET['additLesson'])){
    $data = $conn->prepare("INSERT INTO `_dmp_booking_lessons` (`ID`, `name`) VALUES (NULL, ?)");
    $data->execute([$_GET['lessonText']]);
  }
  if (isset($_SESSION['edit_booking'])){?>
    <div class="noname">
    </div>
    <div class="sqr">
      <div class="back">
        <input type="submit" name="back_edit" value="Go back" class="addit" id="back_edit" style="background-color: var(--primary);">
      </div>
      <h2 style="font-weight: bolder; text-decoration: underline; text-align:center; font-size: 50px; font-family: Courier, monospace;">Adjustments</h2>
      <table style="padding-bottom: 30px;">
        <tr>
          <th>  <input type="submit" name="addRow" value="addRow" id="addRow" class="addRow"></th>
          <td><label for="time">Select time:</label></td>
          <td style="min-width: 600px;">

            <select name="addTime" size="1" class="select1" id="time">
              <option value="6:00">6:00
                <option value="7:00">7:00
                  <option value="8:00">8:00
                    <option value="9:00">9:00
                      <option value="10:00">10:00
                        <option value="11:00">11:00
                          <option value="12:00">12:00
                            <option value="13:00">13:00
                              <option value="14:00">14:00
                                <option value="15:00">15:00
                                  <option value="16:00">16:00
                                    <option value="17:00">17:00
                                      <option value="18:00">18:00
                                        <option value="19:00">19:00
                                          <option value="20:00">20:00
                                            <option value="21:00">21:00
                                              <option value="22:00">22:00
                                              </select><?php  ?>
                                              <input type="submit" name="addIt" value="add" class="addit"></td>
                                              <?php if ($already) {
                                                echo "<h3>This hour is already in this timetable.</h3>";
                                              } ?>
                                            </tr>
                                            <tr>
                                              <th><input type="submit" name="addLesson" value="addLesson" id="addLesson" class="addRow"></th>
                                              <td style="min-width: 125px;"><label for="addLessonid">Add a lesson:</label></td>
                                              <td style="min-width: 750px;">

                                                <input type="text" name="lessonText" class="select1" placeholder="add a lesson.." id="addLessonid">
                                                <input type="submit" name="additLesson" value="add" class="addit"></td>
                                              </tr>
                                              <tr>
                                                <th><input type="submit" name="editLesson" value="editLesson" id="editLesson" class="addRow"></th>
                                                <td><label for="editLessonText">Select a lesson:</label></td>
                                                <td style="min-width: 1250px;">
                                                  <select name="edititLessonText" id="editLessonText" size="1" class="select1" placeholder="select">
                                                    <?php
                                                    $sql = "SELECT `ID`, `name` FROM `_dmp_booking_lessons` WHERE `ID` != '' ORDER BY `name` ASC";
                                                    $data = $conn->query($sql);
                                                    $vysledek = $data->fetchAll();
                                                    foreach ($vysledek as $row) {
                                                      $name = $row['name'];
                                                      $idedit = $row['ID'];
                                                      echo "<option value='".$idedit."'>".$row['name']."</option>";
                                                    }
                                                    ?>
                                                  </select>
                                                  <input type="text" name="editlessonText" class="select1" placeholder="new name..">
                                                  <input type="submit" name="edititLesson" value="edit" class="addit"></td>

                                                </tr>
                                              <tr>
                                                <th><input type="submit" name="delLesson" value="delLesson" id="delLesson" class="addRow"></th>
                                                <td><label for="delLessonText">Select a lesson:</label></td>
                                                <td style="min-width: 800px;">
                                                  <select name="delLessonText" id="delLessonText" size="1" class="select1" placeholder="select">
                                                    <?php
                                                    $sql = "SELECT `name` FROM `_dmp_booking_lessons` WHERE `ID` != '' ORDER BY `name` ASC";
                                                    $data = $conn->query($sql);
                                                    $vysledek = $data->fetchAll();
                                                    foreach ($vysledek as $row) {
                                                      $name = $row['name'];
                                                      echo "<option value='".$name."'>".$row['name']."</option>";
                                                    }
                                                    ?>
                                                  </select><input type="submit" name="deleteitLesson" value="delete" class="addit"></td>
                                                </tr>

                                                </table>
                                              </div><?php
                                            }
                                          }
                                          
                                          ?>
                                        </form>
                                              <input type="button" name="nextWeek" value="Upincomming classes" class="addRow" style="background-color: var(--primary); margin-bottom:20px; margin-top:10px;" onclick="window.location.href = 'main_booking_incomming.php';">
                                      </body>
                                      </html>
