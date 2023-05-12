<?php 
require_once('../config/config.php');
require_once('../utils/Utils.php');
$sql = "INSERT INTO `comments`(`post_id`, `author_id`, `text`) VALUES (:postID, :authorID, :text)";
$args = [
    'postID' => $_GET['postID'],
    'authorID' => $_GET['userID'],
    'text' => $_POST['text']
];
Utils::getInstance() -> getDB() -> execute($sql, $args);
header('Location: ../pages/comments.php?post=' . $_GET['postID']);
?>