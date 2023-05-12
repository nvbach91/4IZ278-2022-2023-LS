<?php
require_once('../utils/Database.php');
require_once('../utils/Utils.php');
$userID = $_GET['userID'];
$postID = $_GET['postID'];
$utils = Utils::getInstance();
$db = $utils -> getDB();
var_dump($utils -> isLiked($userID, $postID));
if ($utils -> isLiked($userID, $postID)) {
    $sql = "DELETE FROM `likes` WHERE `user_id` = :userID AND `post_id` = :postID";
    $db -> execute(
        $sql,
        [
        'userID' => $userID,
        'postID' => $postID
        ]
    );
} else {
    $sql = "INSERT INTO `likes`(`user_id`, `post_id`) VALUES (:userID, :postID)";
    $db -> execute(
        $sql,
        [
            'userID' => $userID,
            'postID' => $postID
        ]
    );
}
header('Location: ../pages/home.php#section' . $postID);
?>