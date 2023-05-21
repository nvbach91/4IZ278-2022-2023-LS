<?php
include_once("by_database.php");
$arr_browsers = ["Opera", "Edg", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];
$agent = $_SERVER['HTTP_USER_AGENT'];
$user_browser = '';
foreach ($arr_browsers as $browser) {
  if (strpos($agent, $browser) !== false) {
    $user_browser = $browser;
    break;
  }
}
switch ($user_browser) {
  case 'MSIE':
  $user_browser = 'Internet Explorer';
  break;
  case 'Trident':
  $user_browser = 'Internet Explorer';
  break;
  case 'Edg':
  $user_browser = 'Microsoft Edge';
  break;
}
if (isset($_SESSION["user"])) {
  $url = $_SERVER['PHP_SELF'];
  $data = $conn->prepare("INSERT INTO `_dmp_detection` (`id`, `browser_name`, `url`, `added_on`, `username`, `_dmp_users_ID`) VALUES (NULL, ?, ?, current_timestamp(), ?, ?)");
  $data->execute([$user_browser, $url, $_SESSION["user"], $_SESSION["iduser"]]);
}
else {
  $url = $_SERVER['PHP_SELF'];
  $data = $conn->prepare("INSERT INTO `_dmp_detection` (`id`, `browser_name`, `url`, `added_on`, `username`, `_dmp_users_ID`) VALUES (NULL, ?, ?, current_timestamp(), '', '0')");
  $data->execute([$user_browser, $url]);
}
$data = $conn->prepare("SELECT COUNT(ID) AS 'count' FROM `_dmp_detection`");
$data->execute();
foreach ($data as $count) {
  if ($count['count'] > 500) {
    $data = $conn->prepare("DELETE FROM `_dmp_detection` ORDER BY `added_on` ASC LIMIT 1");
    $data->execute();
  }
}
$today = time();
$weeknum = date("W", $today);
$data = $conn->prepare("SELECT `week` FROM `_dmp_booking_deletion`");
$data->execute();
foreach ($data as $deleted) {
  if ($weeknum != $deleted['week']) {
    $data = $conn->prepare("DELETE FROM `_dmp_booking` WHERE `week` = '0'");
    $data->execute();
    $data = $conn->prepare("UPDATE `_dmp_booking` SET `week` = '0' WHERE `week` = '1'");
    $data->execute();
    $data = $conn->prepare("UPDATE `_dmp_booking_deletion` SET `week` = $weeknum");
    $data->execute();
  }
}
$date = date('Y-m-d');
if (isset($_SESSION['user'])) {
  $data = $conn->prepare("SELECT `paypal_date` FROM `_dmp_users` WHERE `username` = ?");
  $data->execute([$_SESSION['user']]);
  foreach ($data as $paypal) {
    if ($date >= $paypal['paypal_date']) {
      $data = $conn->prepare("UPDATE `_dmp_users` SET `wallet` = '0', `paypal_date` = '0000-00-00' WHERE `username` = ?");
      $data->execute([$_SESSION["user"]]);
      $_SESSION["paypal_date"] = 'NOT PAID';
    }
  }
}

?>
