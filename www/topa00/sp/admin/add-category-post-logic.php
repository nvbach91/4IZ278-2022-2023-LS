<?php
require '../config/database.php';

if (isset($_POST['add'])) {
  $post_id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
  $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);


  //checking if that category was already chosen
  $query = "SELECT * FROM posts_categories WHERE post_id=$post_id AND category_id=$category_id";
  $result = mysqli_query($db,$query);
  $length = mysqli_num_rows($result);

  //getting categories
  $query = "SELECT id FROM categories WHERE id = $category_id";
  $result = mysqli_query($db,$query);
  $category_length = mysqli_num_rows($result);
  
  if ($length == 1) {
    $_SESSION['add-post-category'] = "Category was already chosen for this post";
  } //check if the chosen category is valid
  elseif( $category_length > 0) {
    $query = "INSERT INTO posts_categories (post_id, category_id) VALUES ('posts_id', 'category_id')";
    $result = mysqli_query($db, $query);

    if(mysqli_errno($db)) {
      $_SESSION['add-post-category'] = "Failed to update post info";
    } else {
      $_SESSION['add-post-category success'] = "Category added successfuly";
    }
  } //inserting data
  else{
    $_SESSION['add-post-category'] = "Invalid category id.";
  }
}

header('location: manage-posts.php');
die();
?>