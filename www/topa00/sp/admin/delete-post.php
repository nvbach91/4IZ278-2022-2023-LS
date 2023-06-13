<?php
  require '../config/database.php';

  if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM posts WHERE id=$id";
    $posts_results = $db->prepare($query);
    $posts_results->execute();
    $posts = $posts_results->fetch(PDO::FETCH_ASSOC);

    if (mysqli_num_rows($result) == 1) {
      $thumbnail_name = $post['thumbnail'];
      $thumbnail_path = '../images/' . $thumbnail_name;

      if ($thumbnail_path) {
        unlink($thimbnail_path);
      }
    }

    $delete_post_query = "DELETE FROM posts WHERE id=$id";
    $delete_posts_results = $db->prepare($query);
    $delete_posts_results->execute();

    if($delete_posts_results->errorCode() !== "00000"){
      $_SESSION['delete-post'] = "Error occured while removing the entry";
    } else {
      $_SESSION['delete-post_success'] = "Successfuly deleted post from the database";
    }
  }

  header('location: manage-posts.php')
?>