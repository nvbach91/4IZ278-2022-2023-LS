<?php 
require('./includes/header.php');
require('./utils.php');
session_start();
$errors = [];
$successes = [];
if (isset($_SESSION['login'])) {
    header('Location: websiteIndex.php');
    exit();
}

$submitedForm = !empty($_POST);
if ($submitedForm) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (!$email) {
        array_push($errors, "Please enter your email");
    }

    if (!$password) {
        array_push($errors, "Please enter your password");
    }

    $user = fetchUser($email)[0];
    if ($user == null){
        array_push($errors, "Users not found. Go to Register first");
    } else if (password_verify($user['password'], $password)) {
        array_push($errors, "Password is not correct");
    }

    if (!count($errors)) {
        header('Location: websiteIndex.php');
        $_SESSION['login'] = $user['user_type'];
        exit();
    }

}

require('./includes/loginBody.php');
?>
