<?php
require '../config/database.php';

if (isset($_POST['submit'])) {
  $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $create_password = filter_var($_POST['create_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $is_admin = filter_var($_POST['is_admin'], FILTER_SANITIZE_NUMBER_INT);
  $avatar = $_FILES['avatar'];

  // validation
  if(!$first_name) {
    $_SESSION['add-user'] = "Please enter your first name";
  } else if (!$last_name) {
    $_SESSION['add-user'] = "Please enter your last name";
  } else if (!$email) {
    $_SESSION['add-user'] = "Please enter valid email";
  } else if (strlen($create_password) < 8) {
    $_SESSION['add-user'] = "The minimum length for the password is 8 characters";
  } else if (!$avatar['name']) {
    $_SESSION['add-user'] = "Please add avatar";
  } else {
    if($create_password !== $confirm_password) {
      $_SESSION['add-user'] = "Passwords do not match";
    } else {
      //creating hash for password
      $hashed_password = password_hash($create_password, PASSWORD_DEFAULT);
    
      $user_check_query = "SELECT * FROM users WHERE email='$email'";
      $user_check_result = $db->prepare($query);
      $user_check_result->execute();
      $num_rows = $user_check_result -> rowCount();

      if($num_rows > 0){
        $_SESSION['add-user'] = "User with this email already exists";
      } else {
        //renaming avatar with timestamp
        $time = time();
        $avatar_name = $time . $avatar['name'];
        $avatar_temp_name = $avatar['tmp_name'];
        $avatar_path = '../images/' . $avatar_name;

        //checking avatar file type
        $allowed_types = ['png', 'jpg', 'jpeg'];
        $extention = explode('.', $avatar_name);
        $extention = end($extention);
        if(in_array($extention, $allowed_types)) {
          //checking image size
          if($avatar['size'] < 1000000) {
            move_uploaded_file($avatar_temp_name, $avatar_path);
          } else {
            $_SESSION['add-user'] = "Avatar should be less then 1Mb";
          }
        } else {
          $_SESSION['add-user'] = "Avatar has to be a .png, .jpg or .jpeg file";
        }
      }
    }
  }
  //redirecting to add-user page if error occured
  if(isset($_SESSION['add-user'])) {
    $_SESSION['add-user_data'] = $_POST;
    header('location: add-user.php');
    die();
  } else {
    // data input in the table
    $insert_user_query = "INSERT INTO users (first_name, last_name, email, password, avatar, is_admin) VALUES ('$first_name','$last_name','$email','$hashed_password','$avatar_name',$is_admin)";
    $insert_user_result = $db->prepare($query);
    $insert_user_result->execute();
    
    if($insert_user_result->errorCode() !== "00000") {
      $_SESSION['add-user_success'] = "New user was successfuly added";
      header('location: manage-users.php');
      die();
    }
  }
} else {
  header('location: add-user.php');
  die();
}

?>