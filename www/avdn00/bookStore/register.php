<?php

include 'config.php';

class RegistrationController
{
    private $connection;
    private $message;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function registerUser()
    {
        if (isset($_POST['submit'])) {
            $email = mysqli_real_escape_string($this->connection, $_POST['email']);
            $confirm_password = mysqli_real_escape_string($this->connection, $_POST['confirm_password']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->message[] = 'Invalid email format';
            } else {
                $existingUser = $this->checkExistingUser($email, $confirm_password);

                if ($existingUser !== false) {
                    $this->message[] = 'User already exists';
                } else {
                    $name = mysqli_real_escape_string($this->connection, $_POST['name']);
                    $password = mysqli_real_escape_string($this->connection, $_POST['password']);
                    $user_type = $_POST['user_type'];

                    $this->createNewUser($name, $email, $password, $user_type);
                }
            }
        }
    }

    private function checkExistingUser($email, $confirm_password)
    {
        $query = "SELECT * FROM `users` WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $confirm_password);
        mysqli_stmt_execute($stmt);
        $select_users = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($select_users) > 0) {
            return true;
        }

        return false;
    }

    private function createNewUser($name, $email, $password, $user_type)
    {
        $query = "INSERT INTO `users`(name, email, password, user_type) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $user_type);
        mysqli_stmt_execute($stmt);
        header('location: login.php');
        exit();
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

$registrationController = new RegistrationController($connection);
$registrationController->registerUser();

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
    $registrationController->displayMessages();
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
                </select>
                <input type="submit" name="submit" value="Register now" class="button">
                <p>Already have an account? <a href="login.php">Login now</a></p>
            </form>
        </div>
    </div>
</body>

</html>