<?php
session_start();
require '../models/UsersDB.php';

$usersDatabase = new UsersDatabase();

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $existing_user = $usersDatabase->fetchByEmail($email);

    if ($email == '') { $message = 'Vyplňte prosím platné přihlašovací údaje.'; array_push($errors, $message); }
    if ($password == '') { $message = 'Vyplňte prosím platné přihlašovací údaje.'; array_push($errors, $message); }

    if ($existing_user !== null) {
        if (password_verify($password, $existing_user['password'])) {
            $_SESSION['user_id'] = $existing_user['user_id'];
            $_SESSION['user_email'] = $existing_user['email'];
    
            header('Location: main.php');
            exit;
        } else {
            $message = "Špatné heslo! Zkuste to znovu.";
            array_push($errors, $message);
        }
    } else {
        $message = 'Uživatel s těmito údaji neexistuje.';
        array_push($errors, $message);
    }   
}
?>