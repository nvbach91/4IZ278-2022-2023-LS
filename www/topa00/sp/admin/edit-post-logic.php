<?php
require '../config/database.php';

if (isset($_POST['update'])) {
  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
  $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if(isset($_SESSION['user_is_admin']) && isset($_POST['is_featured'])): {
  $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
  $is_featured = '1';
} else : {    
    $query = "SELECT * FROM posts WHERE id = $id";
    $posts_results = $db->prepare($query);
    $posts_results->execute();
    $post = $posts_results->fetch(PDO::FETCH_ASSOC);
    $is_featured = $post['is_featured'];
    echo "else" . $is_featured;
  }

  if(!$title OR !$body) {
    $_SESSION['edit-post'] = "Invalid title or body";
  } else{
    if($is_featured == 1) {
      $zero_in_featured_query = "UPDATE posts SET is_featured = 0";
      $zero_in_featured_result = $db->prepare($query);
      $zero_in_featured_result->execute();
    }
  
    if (isset($_SESSION['user_is_admin'])) :{
      $query = "UPDATE posts SET title='$title', body='$body', is_featured='$is_featured', last_modified = now() WHERE id=$id LIMIT 1";
    } else :{
      $query = "UPDATE posts SET title='$title', body='$body', last_modified = now() WHERE id=$id LIMIT 1";
    } endif;
    $posts_results = $db->prepare($query);
    $posts_results->execute();

    if($posts_results->errorCode() !== "00000") {
      $_SESSION['edit-post'] = "Failed to update post info";
    } else {
      $_SESSION['edit-post success'] = "Post info updated successfuly";
    }
  } endif;
}

header('location: manage-posts.php');
die();
?>