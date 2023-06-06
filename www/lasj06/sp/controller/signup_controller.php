<?php
require "../model/db.php";

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

    $stmt = $db->prepare('INSERT INTO users(email, full_name, password, account_level) VALUES (:email, :full_name, :password, 1)');
    $stmt->execute([
        'email' => $email,
        'full_name' => $full_name,
        'password' => $hashedPassword,
    ]);

    $stmt = $db->prepare('SELECT email FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([
        'email' => $email
    ]);
    $user_id = (int) $stmt->fetchColumn();

    $_SESSION['user_email'] = $email;

    header('Location: home.php');
}
