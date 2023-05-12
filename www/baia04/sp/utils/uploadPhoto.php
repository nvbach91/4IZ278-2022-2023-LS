<?php
require('../utils/Utils.php');
$userID = $_GET['userID'];
Utils::getInstance() -> newPost($userID);
header('Location: ../pages/home.php');
exit();
?>