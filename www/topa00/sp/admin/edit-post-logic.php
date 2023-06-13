<?php
if (isset($_POST['update'])) {
  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
  $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);

  if(!$title OR !$body) {
    $_SESSION['edit-post'] = "Invalid title or body";
  } else {
    if($is_featured == 1) {
      $zero_in_featured_query = "UPDATE posts SET is_featured = 0";
      $zero_in_featured_result = mysqli_query($db, $zero_in_featured_query);
    }
    
    $query = "UPDATE posts SET title='$title', body='$body', is_featured='$is_featured' WHERE id=$id LIMIT 1";
    $result = mysqli_query($db, $query);

    if(mysqli_errno($db)) {
      $_SESSION['edit-post'] = "Failed to update post info";
    } else {
      $_SESSION['edit-post success'] = "Post info updated successfuly";
    }
  }
}

header('location: manage-posts.php');
die();
?>