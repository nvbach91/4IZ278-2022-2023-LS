<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
  $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
  // validation
  if(!$title) {
    $_SESSION['add-category'] = "Please enter title";
  } else if (!$description) {
    $_SESSION['add-category'] = "Please enter description";
  } 

  //redirecting to add-category page if error occured
  if(isset($_SESSION['add-category'])) {
    $_SESSION['add-category_data'] = $_POST;
    header('location: add-category.php');
    die();
  } else {
    // data input in the table
    $query = "INSERT INTO categories (title, description) VALUES ('$title','$description')";
    $result = mysqli_query($db, $query);
    
    if(mysqli_errno($db)) {
      $_SESSION['add-category_error'] = "Error occured while adding category";
      header('location: add-category.php');
      die();
    } else {
      $_SESSION['add-category_success'] = "Successfuly added category";
      header('location: manage-categories.php');
      die();
    }
  }
} else {
  header('location: add-category.php');
  die();
}

?>