<?php
session_start();

require_once 'db/UsersDB.php'; 

$username = $_POST['username'];
$password = $_POST['password'];

$userDB = new UsersDB();
$user = $userDB->getByUsername($username);

if ($user) {
    $hashed_password = $user['password'];

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $username;
        header("Location: pages/logged_in/logged_in.php");
    } else {
        header("Location: index.html?error=incorrect_password");
    }
} else {
    header("Location: index.html?error=user_not_found");
}
?>
