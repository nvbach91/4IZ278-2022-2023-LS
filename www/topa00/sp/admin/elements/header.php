<?php
require '../config/database.php';

if(isset($_SESSION['user_id'])) {
  $id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT avatar FROM users WHERE id=$id";
  $result = $db->prepare($query);
  $result->execute();
  $avatar = $result->fetch(PDO::FETCH_ASSOC);
} else {
  header('location: ../signin.php');
  die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="icon" href="../images/blog-b.png" type="image/x-icon">
  <title>Blogist</title>

  <link rel="stylesheet" href="../styles/main.css">
  <link rel="stylesheet" href="../styles/dashboard.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600;700;800&family=Roboto:wght@100;400&display=swap" rel="stylesheet">
</head>
<body>
  
  <navigation>
    <div class="container navigation_container">
      <a href="../index.php" class="navigation_logo">Blogist</a>
      <ul class="navigation_items">
        <li><a href="../blog.php">Blog</a></li>
        <li><a href="../about.php">About</a></li>
        <li><a href="../contacts.php">Contacts</a></li>
        <?php if(isset($_SESSION['user_id'])): ?>
          <li class="navigation_profile">
            <div class="avatar">
              <img src="<?='../images/' . $avatar['avatar']?>">
            </div>
            <ul>
              <li><a href="admin/dashboard.php">Dashboard</a></li>
              <li><a href="../logout.php">Log Out</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li><a href="../signin.php">Sign In</a></li>
        <?php endif ?>
      </ul>
    </div>
  </navigation>