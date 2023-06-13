<?php
  require '../config/database.php';

  if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($db, $query);
    $category = mysqli_fetch_assoc($result);

    $delete_category_query = "DELETE FROM categories WHERE id=$id";
    $delete_category_result = mysqli_query($db, $delete_category_query);
    if (mysqli_errno($db)){
      $_SESSION['delete-category'] = "Error occured while removing the entry";
    } else {
      $_SESSION['delete-category_success'] =  "Successfuly deleted category from the database";
    }
  }

  header('location: manage-categories.php')
?>