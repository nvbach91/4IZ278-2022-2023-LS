<?php

use function PHPSTORM_META\type;

require './config/database.php';
$post_id = filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT);
$user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
$status = filter_var($_GET['status'], FILTER_SANITIZE_NUMBER_INT);
$type = filter_var($_GET['type'], FILTER_SANITIZE_SPECIAL_CHARS);

if ($type == 'like'){
  $value = 1;
} else {
  $value = -1;
}

    $query = "SELECT * FROM ratings WHERE post_id = $post_id AND user_id = $user_id";
    $result = $db->prepare($query);
    $result->execute();
    $num_rows = $result->rowCount();

    if ($num_rows > 0){
      if ($status == $value){
        $query = "UPDATE ratings SET rating_status = '0' WHERE (post_id, user_id) IN (($post_id, $user_id))";
      } else
      $query = "UPDATE ratings SET rating_status = $value WHERE (post_id, user_id) IN (($post_id, $user_id))";
    } else {
      $query = "INSERT INTO ratings (post_id, user_id, rating_status) VALUES ('$post_id', '$user_id', '$value')";
    }
    $result = $db->prepare($query);
    $result->execute();
?>