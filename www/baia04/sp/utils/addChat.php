<?php 
require_once '../utils/Utils.php';
$db = Utils::getInstance() -> getDB();
$users = [
    'user1ID' => $_GET['user1ID'],
    'user2ID' => $_GET['user2ID']
];
$sql = "SELECT * FROM `chats` WHERE (`user1_id` = :user1ID AND `user2_id` = :user2ID) OR (`user1_id` = :user2ID AND `user2_id` = :user1ID)";
$existsDialogue = $db -> execute($sql, $users);
if (count($existsDialogue)) {
    header('Location: ../pages/chat.php?companionID=' . $_GET['user2ID']);
    return;
}
$sql = "INSERT INTO `chats`(`user1_id`, `user2_id`) VALUES (:user1ID, :user2ID)";
$db -> execute($sql, $users);
header('Location: ../pages/chat.php?companionID=' . $_GET['user2ID']);
?>