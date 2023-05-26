<?php
require('../utils/Utils.php');
$userID = $_GET['userID'];
Utils::getInstance() -> changeProfile($userID);
header('Location: ../pages/profile.php');
exit();
?>