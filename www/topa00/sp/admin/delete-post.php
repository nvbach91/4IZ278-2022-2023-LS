<?php
  require '../config/database.php';

  if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($db, $query);
    $post = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) == 1) {
      $thumbnail_name = $post['thumbnail'];
      $thumbnail_path = '../images/' . $thumbnail_name;

      if ($thumbnail_path) {
        unlink($thimbnail_path);
      }
    }

    $delete_post_query = "DELETE FROM posts WHERE id=$id";
    $delete_post_result = mysqli_query($db, $delete_post_query);
    if (mysqli_errno($db)){
      $_SESSION['delete-post'] = "Error occured while removing the entry";
    } else {
      $_SESSION['delete-post_success'] = "Successfuly deleted post from the database";
    }
  }

  header('location: manage-posts.php')
?>