<?php
require_once '../utils/Utils.php';
$db = Utils::getInstance() -> getDB();
$sql = "DELETE FROM `users` WHERE `user_id` = :userID";
$db -> execute(
    $sql,
    ['userID' => $_GET['userID']]
);
header('Location: ../pages/admin.php');
?>