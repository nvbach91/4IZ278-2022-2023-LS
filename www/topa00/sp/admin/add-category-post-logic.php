<?php
require '../config/database.php';

if (isset($_POST['add'])) {
  $post_id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
  $category_title = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  //getting categories
  $query = "SELECT * FROM categories WHERE title = '$category_title'";
  $category_result = $db->prepare($query);
  $category_result->execute();
  $category_length = $category_result->rowCount();
  $category = $category_result->fetch(PDO::FETCH_ASSOC);
  $category_id = $category['id'];

  //checking if that category was already chosen
  $query = "SELECT * FROM posts_categories WHERE post_id=$post_id AND category_id=$category_id";
  $link_results = $db->prepare($query);
  $link_results->execute();
  $length = $link_results->rowCount();
  
  if ($length > 1) {
    $_SESSION['add-post-category'] = "Category was already chosen for this post";
  } //check if the chosen category is valid
  elseif( $category_length > 0) {
    $query = "INSERT INTO posts_categories (post_id, category_id) VALUES ('$post_id', '$category_id')";
    $input_results = $db->prepare($query);
    $input_results->execute();

    if($input_results->errorCode() !== "00000") {
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