<?php
require_once '../utils/Utils.php';
$sql = "DELETE FROM `friends` WHERE (`user1_id` = :user1ID AND `user2_id` = :user2ID) OR (`user1_id` = :user2ID AND `user2_id` = :user1ID)";
$users = [
    'user1ID' => $_GET['user1ID'],
    'user2ID' => $_GET['user2ID']
];
Utils::getInstance() -> getDB() -> execute($sql, $users);
header('Location: ../setSession.php?page=friends');
?>