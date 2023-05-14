<?php

include 'config.php';

if(isset($_POST['submit'])){
    // mysqli_real_escape_string escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);
    $user_type = $_POST['user_type'];

    $query = "SELECT * FROM `users` WHERE email = '$email' AND password = '$confirm_password'";
    $select_users = mysqli_query($connection, $query) or die('query failed');

    if(mysqli_num_rows($select_users) > 0) {
        $message[] = 'User already exists';
    } else {
        if($password != $confirm_password) {
            $message[] = 'Password and confirm password do not match';
        } else {
            $query = "INSERT INTO `users`(name, email, password, user_type) VALUES ('$name', '$email', '$confirm_password', '$user_type')";
            mysqli_query($connection, $query) or die('query failed');
            $message[] = 'User was successfully registered';
            header('location:login.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
            <h3>Registration</h3>
            <input type="text" name="name" placeholder="Enter your name" required class="box">
            <input type="email" name="email" placeholder="Enter your email" required class="box">
            <input type="password" name="password" placeholder="Enter your password" required class="box">
            <input type="password" name="confirm_password" placeholder="Confirm your password" required class="box">
            <select name="user_type" class="box">
                <option value="user">User</option>
		<option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="Register now" class="button">
            <p>Already have an account? <a href="login.php">Login now</a></p>
        </form>
    </div>
</div>
    

    
</body>
</html>