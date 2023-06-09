<?php

include 'config.php';
session_start();
if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
    $select_users = mysqli_query($connection, $query) or die('query failed');

    if(mysqli_num_rows($select_users) > 0) {

        $row = mysqli_fetch_assoc($select_users);
        
        if($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_php/admin_home.php');
        } elseif($row['user_type'] == 'user') {
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_id'] = $row['id'];
            header('location:customer_php/home.php');
        }
        
    } else {
        $message[] = 'Wrong password or email';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <?php
    
    if(isset($message)) {
        foreach($message as $message) {
            echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
             </div>
            ';
        }
    }
    
    ?>

 <div class="window">
    <div class="logo-container">
        <div class="logo">
            <p>Book<span>Worms</span><img alt="logo" src="./img/open-book.png"></p>
        </div>
    </div>
    <div class="form-container">
        <form action="" method="post">
            <h3>Login form</h3>
            <input type="email" name="email" placeholder="Enter your email" required class="box">
            <input type="password" name="password" placeholder="Enter your password" required class="box">
            <input type="submit" name="submit" value="Log in now" class="button">
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </form>
    </div>
 </div>
</body>
</html>