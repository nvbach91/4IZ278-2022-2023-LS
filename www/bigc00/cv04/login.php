<?php 
require('./includes/header.php');
require('./utils.php');

$errors = [];
$successes = [];

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

    $user = fetchUser($email);
    if ($user == null){
        array_push($errors, "Users not found. Go to Register first");
    } else if ($user['password'] != $password) {
        array_push($errors, "Password is not correct");
    }

    if (!count($errors)) {
        array_push($successes, "You are successfully log in!");
    }

}

require('./includes/loginBody.php');
?>
