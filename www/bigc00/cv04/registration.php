<?php 
require('./includes/header.php');
require('./utils.php');

$errors = [];
$successes = [];

$submitedForm = !empty($_POST);
if ($submitedForm) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));

    if (!$name) {
        array_push($errors, 'Please enter your name');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Please enter valid email");
    }

    if (!$password) {
        array_push($errors, "Please enter a password");
    } else if (strlen($password) < 6) {
        array_push($errors, "Password must contain at least 6 symbols");
    } else if ($password != $confirmPassword) {
        array_push($errors, "Passwords don't match");
    }

    if (!count($errors) && fetchUser($email) == null) {
        array_push($successes, "You succesfully signed up! Go to Login");
        saveUser($name, $email, $password);
    } else if (!count($errors)) {
        array_push($successes, "You are already registered. Go to Login!");
    }

}

require('./includes/registrationBody.php');
?>
