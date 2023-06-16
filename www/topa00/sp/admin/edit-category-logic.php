<?php
if (isset($_POST['update'])) {
  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
  $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if(!$title OR !$description) {
    $_SESSION['edit-category'] = "Invalid title or description";
  } else {
    $query = "UPDATE categories SET title='$title', description='$description' WHERE id=$id LIMIT 1";
    $posts_results = $db->prepare($query);
    $posts_results->execute();

    if($posts_results->errorCode() !== "00000") {
      $_SESSION['edit-category'] = "Failed to update post info";
    } else {
      $_SESSION['edit-category success'] = "Post info updated successfuly";
    }
  }
}

header('location: manage-categories.php');
die();
?>