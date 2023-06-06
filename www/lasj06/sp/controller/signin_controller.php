<?php
require '../model/users.php';

session_start();

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $existing_user = signin($email);

    if ($email == '') {
        $message = 'Please fill out your email';
        array_push($errors, $error);
    }
    
    if ($password == '') {
        $message = 'Please fill out your password';
        array_push($errors, $error);
    }

    if ($existing_user != null) {
        if (password_verify($password, $existing_user['password'])) {
            $_SESSION['user_email'] = $existing_user['email'];
            $_SESSION['account_level'] = $existing_user['account_level'];

            header('Location: home.php');
            exit;
        } else {
            $error = 'Incorrect Password';
            array_push($errors, $error);
        }
    } else {
        $error = 'There is no account associated with this email address.';
        array_push($errors, $error);
    }
    
}
