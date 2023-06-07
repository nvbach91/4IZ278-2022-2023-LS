<?php
require 'config/database.php';
if (isset($_POST['submit'])){
  $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if(!$email){
    $_SESSION['signin'] = 'Email required';
  } else if (!$password) {
    $_SESSION['signin'] = 'Password Required';
  } else {
    $fetch_user_query = "SELECT * FROM users WHERE email='$email'";
    $fetch_user_result = mysqli_query($db, $fetch_user_query);

    if(mysqli_num_rows($fetch_user_result) == 1) {
      $user_record = mysqli_fetch_assoc($fetch_user_result);
      $db_password = $user_record['password'];

      if(password_verify($password,$db_password)) {
        $_SESSION['user_id'] = $user_record['id'];
        if($user_record['is_admin'] == 1) {
          $_SESSION['user_is_admin'] = true;
        }

        header('location: admin/dashboard.php');
      } else {
        $_SESSION['signin'] = "Please check your input";
      }
    } else {
      $_SESSION['signin'] = "User not found";
    }
  }

  if(isset($_SESSION['signin'])) {
    $_SESSION['signin_data'] = $_POST;
    header('location: signin.php');
    die();
  }
} else {
  header('location: signin.php');
  die();
}