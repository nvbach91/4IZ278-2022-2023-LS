<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
  $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $create_password = filter_var($_POST['create_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $avatar = $_FILES['avatar'];

  // validation
  if(!$first_name) {
    $_SESSION['signup'] = "Please enter your first name";
  } else if (!$last_name) {
    $_SESSION['signup'] = "Please enter your last name";
  } else if (!$email) {
    $_SESSION['signup'] = "Please enter valid email";
  } else if (strlen($create_password) < 8) {
    $_SESSION['signup'] = "The minimum length for the password is 8 characters";
  } else if (!$avatar['name']) {
    $_SESSION['signup'] = "Please add avatar";
  } else {
    if($create_password !== $confirm_password) {
      $_SESSION['signup'] = "Passwords do not match";
    } else {
      //creating hash for password
      $hashed_password = password_hash($create_password, PASSWORD_DEFAULT);
    
      $user_check_query = "SELECT * FROM users WHERE email='$email'";
      $result = $db->prepare($user_check_query);
      $result->execute();
      $num_rows = $result->rowCount();

      if($num_rows > 0){
        $_SESSION['signup'] = "User with this email already exists";
      } else {
        //renaming avatar with timestamp
        $time = time();
        $avatar_name = $time . $avatar['name'];
        $avatar_temp_name = $avatar['tmp_name'];
        $avatar_path = 'images/' . $avatar_name;

        //checking avatar file type
        $allowed_types = ['png', 'jpg', 'jpeg'];
        $extention = explode('.', $avatar_name);
        $extention = end($extention);
        if(in_array($extention, $allowed_types)) {
          //checking image size
          if($avatar['size'] < 1000000) {
            move_uploaded_file($avatar_temp_name, $avatar_path);
          } else {
            $_SESSION['signup'] = "Avatar should be less then 1Mb";
          }
        } else {
          $_SESSION['signup'] = "Avatar has to be a .png, .jpg or .jpeg file";
        }
      }
    }
  }
  //redirecting to signup page if error occured
  if(isset($_SESSION['signup'])) {
    $_SESSION['signup_data'] = $_POST;
    header('location: signup.php');
    die();
  } else {
    // data input in the table
    $insert_user_query = "INSERT INTO users (first_name, last_name, email, password, avatar, is_admin) VALUES ('$first_name','$last_name','$email','$hashed_password','$avatar_name',0)";
    $insert_user_data = $db->prepare($insert_user_query);
    $insert_user_data->execute();
    $num_rows = $insert_user_data->rowCount();
    
    if($num_rows > 0) {
      $alert = sendConformation($email, $first_name, $last_name);
      $_SESSION['signup_success'] = "Registration successful. " . $alert;
      header('location: signin.php');
      die();
    }
  }
} else {
  header('location: signup.php');
  die();
}


function sendConformation($email, $first_name, $last_name){
  $subject = 'Registration Conformation - Welcome to Blogist';
  $text = nl2br('Dear ' . $first_name . ' ' . $last_name . ',\n\n');
  $text .= nl2br('Congratulations! We are thrilled to inform you that your registration with Blogist has been successfully completed. Welcome to our community!\n\n');
  $text .= nl2br('Best regards,\n');
  $text .= 'Blogist';

  $text .= wordwrap($text, 70);

  $headers = [
    'MIME-Version: 1.0',
    'Content-type: text/plain; charset=utf-8',
    'From: contacts@blogist.com',
    'Reply-To: contacts@blogist.com',
    'X-Mailer: PHP/'.phpversion()
];

  $headers = implode("\r\n", $headers);

  if (mail($email, $subject, $text, $headers)){
    $alert = 'Conformation email was sent to your adress';
  }else{
    $alert = 'Error occured while sending conformation email to your adress';
  }

  return $alert;
}
?>