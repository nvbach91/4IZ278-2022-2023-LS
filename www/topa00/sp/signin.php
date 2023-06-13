<?php
require 'config/constants.php';

$email = $_SESSION['signin_data']['email'] ?? null;
$password = $_SESSION['signin_data']['password'] ?? null;

unset($_SESSION['signin_data']);
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
    <h2>Sign In</h2>
    <?php if(isset($_SESSION['signup_success'])): ?>
    <div class="alert-message success">
      <p>
        <?= $_SESSION['signup_success'];
        unset($_SESSION['signup_success'])
        ?>
      </p>
    </div>
    <?php elseif(isset($_SESSION['signin'])): ?>
    <div class="alert-message error">
      <p>
        <?= $_SESSION['signin'];
        unset($_SESSION['signin'])
        ?>
      </p>
    </div>
    <?php endif ?>
    <form action="signin-logic.php" method="POST">
      <input type="email" name="email" value="<?=$email?>" placeholder="Email">
      <input type="password" name="password" value="<?=$password?>" placeholder="Password">
      <button type="submit" name="submit" class="button">Sign In</button>
      <small>Don't have an account? <a href="signup.php">Sign up</a></small>
    </form>
  </div>
</section>
</body>
</html>