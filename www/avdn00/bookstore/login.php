<?php

include 'config.php';
require 'github-config.php';

class LoginController
{
    private $connection;
    private $message;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function loginUser()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } elseif (isset($_POST['submit'])) {
            $email = mysqli_real_escape_string($this->connection, $_POST['email']);
            $password = mysqli_real_escape_string($this->connection, $_POST['password']);

            $existingUser = $this->checkExistingUser($email, $password);

            if ($existingUser !== false) {
                $this->handleUserLogin($existingUser);
            } else {
                $this->message[] = 'Wrong password or email';
            }
        }
    }

    private function checkExistingUser($email, $password)
    {
        $query = "SELECT * FROM `users` WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $select_users = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($select_users) > 0) {
            return mysqli_fetch_assoc($select_users);
        }

        return false;
    }

    private function handleUserLogin($user)
    {
        if ($user['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $user['name'];
            $_SESSION['admin_email'] = $user['email'];
            $_SESSION['admin_id'] = $user['id'];
            header('location:admin_php/admin_home.php');
            exit;
        } elseif ($user['user_type'] == 'user') {
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_id'] = $user['id'];
            header('location:customer_php/home.php');
            exit;
        }
    }

    public function displayMessages()
    {
        if (isset($this->message)) {
            foreach ($this->message as $message) {
                echo '
                <div class="message">
                    <span>' . htmlspecialchars($message) . '</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
                ';
            }
        }
    }
}

$loginController = new LoginController($connection);
$loginController->loginUser();

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
    $loginController->displayMessages();
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
                <input type="button" value="Log in with GitHub" class="option-button" onclick="window.location = 'github-login.php'">
                <p>Don't have an account? <a href="register.php">Register now</a></p>
            </form>
        </div>
    </div>
</body>

</html>