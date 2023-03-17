<?php
require 'utils.php';

$users = getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/card_style.css">       
</head>
<h1 >Registered users</h1>
  <body>

  <?php foreach($users as $user): ?>
    <div class="card">
    <div class="avatar" style = "background-image: url(<?php echo $user['avatar'] ?>)"></div>
        <div class = "content">            
            <div class="FirstName"><?php echo $user['firstName'] ?></div>
            <div class="LastName"><?php echo $user['lastName'] ?></div>
            <div class="contact"><?php echo $user['email'] ?></div>
            <div class="contact"> <?php echo $user['phone'] ?></div>
        </div>    
    </div>
  </body>
  <?php endforeach; ?>
</html>