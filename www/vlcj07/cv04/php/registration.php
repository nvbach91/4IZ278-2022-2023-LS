<?php 

require './utils.php';

$errors = [];

$formIsSubmitted = !empty($_POST);

if($formIsSubmitted) {

    $email = htmlspecialchars(trim($_POST['email']));
    $name = htmlspecialchars(trim($_POST['name']));
    $password = htmlspecialchars(trim($_POST['password']));
    $checkPassword = htmlspecialchars(trim($_POST['check-password']));

    if ($email == '') { $message = 'Email is empty'; array_push($errors, $message); }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $message = "Invalid E-mail"; array_push($errors, $message); }

    if (strlen($password) < 8) { $message = "Invalid password"; array_push($errors, $message); }

    if ($checkPassword !== $password) { $message = "Passwords are not same"; array_push($errors, $message); }

    $existingUser = fetchUser($email);

    if ($existingUser != null) { $message = 'This email is already used'; array_push($errors, $message); }

    if (empty($errors)) {
        registerNewUser([$email, $name, $password]);
        header('Location: login-form.php'); 
        exit;
    }
}
?>