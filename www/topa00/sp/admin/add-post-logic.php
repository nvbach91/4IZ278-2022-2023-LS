<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
  $author_id= $_SESSION['user_id'];
  $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
  $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
  $thumbnail = $_FILES['thumbnail'];

  $is_featured = $is_featured == 1 ?: 0;
  // validation
  if(!$title) {
    $_SESSION['add-post'] = "Please enter title";
  } else if (!$category_id) {
    $_SESSION['add-post'] = "Please select category";
  } else if (!$body) {
    $_SESSION['add-post'] = "Please enter post body";
  } else if (!$thumbnail['name']) {
    $_SESSION['add-post'] = "Choose post thumbnail";
  } else {
        $time = time();
        $thumbnail_name = $time . $thumbnail['name'];
        $thumbnail_temp_name = $thumbnail['tmp_name'];
        $thumbnail_path = '../images/' . $thumbnail_name;

        //checking thumbnail file type
        $allowed_types = ['png', 'jpg', 'jpeg'];
        $extention = explode('.', $thumbnail_name);
        $extention = end($extention);
        if(in_array($extention, $allowed_types)) {
          //checking image size
          if($avatar['size'] < 2000000) {
            move_uploaded_file($thumbnail_temp_name, $thumbnail_path);
          } else {
            $_SESSION['add-user'] = "Thumbnail should be less then 1Mb";
          }
        } else {
          $_SESSION['add-user'] = "Thumbnail has to be a .png, .jpg or .jpeg file";
        }
      }

  //redirecting to add-post page if error occured
  if(isset($_SESSION['add-post'])) {
    $_SESSION['add-post_data'] = $_POST;
    header('location: add-post.php');
    die();
  } else {
    if($is_featured == 1) {
      $zero_in_featured_query = "UPDATE posts SET is_featured = 0";
      $zero_in_featured_result = mysqli_query($db, $zero_in_featured_query);
    }
    // data input in the table
    $query = "INSERT INTO posts (title, body, thumbnail, author_id, is_featured) VALUES ('$title','$body','$thumbnail_name','$author_id',$is_featured)";
    $idata = mysqli_query($db, $query);

    $query = "SELECT MAX(id) AS id FROM posts";
    $id_result = mysqli_query($db, $query);
    $id = mysqli_fetch_assoc($id_result);
    $post_id = $id['id'];

    //creating links for many:many
    $link_query = "INSERT INTO posts_categories (post_id, category_id) VALUES ('$post_id', '$category_id')";
    $link_input = mysqli_query($db, $link_query);
    
    if(!mysqli_errno($db)) {
      $_SESSION['add-post_success'] = "New post was successfuly added" . $post_id;
      header('location: manage-posts.php');
      die();
    }
  }
}

  header('location: add-post.php');
  die();

?>