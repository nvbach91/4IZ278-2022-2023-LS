<?php 
require_once('../config/config.php');
require_once('../utils/Utils.php');
$utils = Utils::getInstance();
$db = $utils -> getDB();
$postID = $_GET['postID'];
$authorID = $_GET['userID'];
if (!$db -> getUserByField($authorID, 'user_id') || !$db -> getPostByID($postID)) {
    header('Location: ../pages/home.php');
    exit();
}
$args = [
    'postID' => $_GET['postID'],
    'authorID' => $_GET['userID'],
    'text' => $_POST['text'] ? htmlspecialchars($_POST['text']) : ""
];

$sql = "INSERT INTO `comments`(`post_id`, `author_id`, `text`) VALUES (:postID, :authorID, :text)";
$db -> execute($sql, $args);
header('Location: ../pages/comments.php?post=' . $_GET['postID']);
?>