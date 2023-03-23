<?php 

require './utils.php';

$email = isset($_GET['email']) ? $_GET['email'] : '';

$errors = [];

$formIsSubmitted = !empty($_POST);
if ($formIsSubmitted) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $existingUser = fetchUser($email);
    if ($existingUser != null) {
        if ($existingUser['password'] == $password) {
            header('Location: home.php');
            exit;
        } else {
            $message = "Invalid password"; 
            array_push($errors, $message);
        }
    } else {
        $message = "User does not exist"; 
        array_push($errors, $message);
    }
}