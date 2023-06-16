<?php
  require '../config/database.php';

  if(isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM categories WHERE id=$id";
    $category_result = $db->prepare($category_query);
    $category_result->execute();
    $category = $category_result->fetch(PDO::FETCH_ASSOC);

    $delete_category_query = "DELETE FROM categories WHERE id=$id";
    $delete_category_results = $db->prepare($query);
    $delete_category_results->execute();

    if($delete_category_results->errorCode() !== "00000"){
      $_SESSION['delete-category'] = "Error occured while removing the entry";
    } else {
      $_SESSION['delete-category success'] =  "Successfuly deleted category from the database";
    }
  }

  header('location: manage-categories.php')
?>