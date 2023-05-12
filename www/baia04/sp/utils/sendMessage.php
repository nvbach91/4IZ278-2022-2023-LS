<?php 
require_once '../utils/Utils.php';
if (!$_POST['text']) {
    header('Location: ../pages/chat.php?companionID=' . $_GET['companionID']);
    return;
}
$utils = Utils::getInstance();
$db = $utils -> getDB();
$sql = "SELECT `chat_id` FROM `chats` WHERE (`user1_id` = :user1ID AND `user2_id` = :user2ID) OR (`user1_id` = :user2ID AND `user2_id` = :user1ID)";
$chatID = $db -> execute(
    $sql,
    [
        'user1ID' => $_GET['companionID'],
        'user2ID' => $_GET['userID']
    ]
)[0]['chat_id'];
$sql = "INSERT INTO `messages`(`chat_id`, `author_id`, `message`, `is_read`) VALUES (:chatID, :authorID, :message, false)";
$db -> execute(
    $sql, 
    [
        'chatID' => $chatID,
        'authorID' => $_GET['userID'],
        'message' => $_POST['text']
    ]
);
header('Location: ../pages/chat.php?companionID=' . $_GET['companionID']);
?>