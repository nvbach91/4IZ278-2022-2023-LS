<?php
require 'config/constants.php';

$first_name = $_SESSION['signup_data']['first_name'] ?? null;
$last_name = $_SESSION['signup_data']['last_name'] ?? null;
$email = $_SESSION['signup_data']['email'] ?? null;
$create_password = $_SESSION['signup_data']['create_password'] ?? null;
$confirm_password = $_SESSION['signup_data']['confirm_password'] ?? null;
unset($_SESSION['signup_data'])
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" href="./images/blog-b.png" type="image/x-icon">
  <title>Blogist</title>

  <link rel="stylesheet" href="./styles/main.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600;700;800&family=Roboto:wght@100;400&display=swap" rel="stylesheet">
</head>

<body>
<section class="form-section">
  <div class="container form-section_container">
    <h2>Sign Up</h2>
    <?php if(isset($_SESSION['signup'])): ?>
      <div class="alert-message error">
        <p>
          <?= $_SESSION['signup']; 
          unset($_SESSION['signup']);?>
        </p>
      </div>
    <?php endif ?>
    <form action="signup-logic.php" enctype="multipart/form-data" method="POST">
      <input type="text" name="first_name" value="<?=$first_name?>" placeholder="First Name">
      <input type="text" name="last_name" value="<?=$last_name?>" placeholder="Last Name">
      <input type="email" name="email" value="<?=$email?>" placeholder="Email">
      <input type="password" name="create_password" value="<?=$create_password?>" placeholder="Create password">
      <input type="password" name="confirm_password" value="<?=$confirm_password?>" placeholder="Confirm password">
      <div class="form-control">
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" id="avatar">
      </div>
      <button type="submit" name="submit" class="button">Sign Up</button>
      <small>Already have an account? <a href="signin.php">Sign in</a></small>
    </form>
  </div>
</section>
</body>
</html>