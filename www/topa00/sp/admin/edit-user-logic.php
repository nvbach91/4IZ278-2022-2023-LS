<?php
if (isset($_POST['submit'])) {
  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
  $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $is_admin = filter_var($_POST['is_admin'], FILTER_SANITIZE_NUMBER_INT);

  if(!$first_name OR !$last_name) {
    $_SESSION['edit-user'] = "Invalid first or last name";
  } else {
    $query = "UPDATE users SET first_name='$first_name', last_name='$last_name', is_admin='$is_admin' WHERE id=$id LIMIT 1";
    $result = mysqli_query($db, $query);

    if(mysqli_errno($db)) {
      $_SESSION['edit-user'] = "Failed to update user info";
    } else {
      $_SESSION['edit-user success'] = "User info updated successfuly";
    }
  }
}

header('location: manage-users.php');
die();
?>