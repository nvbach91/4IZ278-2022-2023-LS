<?php 
require_once '../utils/Utils.php';
$db = Utils::getInstance() -> getDB();
$users = [
    'user1ID' => $_GET['user1ID'],
    'user2ID' => $_GET['user2ID']
];
$sql = "SELECT * FROM `friends` WHERE (`user1_id` = :user1ID AND `user2_id` = :user2ID) OR (`user1_id` = :user2ID AND `user2_id` = :user1ID)";
$existsFrendShip = $db -> execute($sql, $users);
if (count($existsFrendShip)) {
    header('Location: ../pages/profile.php?companionID=' . $_SESSION['profileID']);
    return;
}
$sql = "INSERT INTO `friends`(`user1_id`, `user2_id`) VALUES (:user1ID, :user2ID)";
$db -> execute($sql, $users);
header('Location: ../utils/setSession.php?page=friends');
?>