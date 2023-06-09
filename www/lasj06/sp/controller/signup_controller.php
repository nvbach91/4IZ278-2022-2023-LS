<?php
require "../model/users.php";

session_start();

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $password = $_POST['password'];

    if ($email == '') {
        $message = 'Please fill out your email.';
        array_push($errors, $error);
    }

    if ($full_name == '') {
        $message = 'Please fill out your full legal name.';
        array_push($errors, $error);
    }

    if ($password == '') {
        $message = 'Please choose a safe password.';
        array_push($errors, $error);
    }

    if (strlen($password) > 0 && strlen($password) < 8) {
        $message = 'Please choose a safe password, it should be at least 8 symbols long and idealy containg a combination of letters, capital letters, numbers and special symbols.';
        array_push($errors, $error);
    }


    //ošetřit vstupy

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    signUp($email, $full_name, $hashedPassword);

    $user = signIn($email);
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['account_level'] = $user['account_level'];

    header('Location: home.php');
}
