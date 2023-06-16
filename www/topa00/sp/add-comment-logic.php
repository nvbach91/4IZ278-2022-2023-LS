<?php
require './config/database.php';

if (isset($_POST['submit'])) 
{
  $post_id= $_SESSION['post_id'];
  $author_id= $_SESSION['user_id'];
  $parent_id = filter_var($_POST['parent_id'], FILTER_SANITIZE_NUMBER_INT);
  $comment = filter_var($_POST['comment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if(!$comment) {
    $_SESSION['add-comment'] = "Invalid comment text";
  } else {
    if (!$parent_id) {
      $query = "INSERT INTO comments (author_id, post_id, comment) VALUES ('$author_id', '$post_id', '$comment')";
    } else {
      $query = "INSERT INTO comments (parent_id, author_id, post_id, comment) VALUES ('$parent_id', '$author_id', '$post_id', '$comment')";
    }
    $posts_results = $db->prepare($query);
    $posts_results->execute();

    if($posts_results->errorCode() !== "00000") {
      $_SESSION['add-comment'] = "Failed to add comment";
    } else {
      $_SESSION['add-comment success'] = "Comment added successfuly";
    }
  }
} 
header('location: post.php?id=' . $post_id);
die();
?>