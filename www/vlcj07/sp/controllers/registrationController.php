<?php
session_start();
require '../models/UsersDB.php';

$usersDatabase = new UsersDatabase();

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {

    $role = 'user';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $country = $_POST['country'];
    $zipCode = $_POST['zip_code'];
    $city = $_POST['city'];
    $adress = $_POST['adress'];
    $phone = $_POST['phone'];


    if ($email == '') { $message = 'Vyplňte email.'; array_push($errors, $message); }
    if ($name == '') { $message = 'Vyplňte jméno a příjmení.'; array_push($errors, $message); }
    if ($country == '') { $message = 'Vyplňte stát bydliště.'; array_push($errors, $message); }
    if ($zipCode == '') { $message = 'Vyplňte poštovní směrovací číslo.'; array_push($errors, $message); }
    if ($city == '') { $message = 'Vyplňte obec.'; array_push($errors, $message); }
    if ($adress == '') { $message = 'Vyplňte ulici a č.p.'; array_push($errors, $message); }
    if ($phone == '') { $message = 'Vyplňte telefonní číslo.'; array_push($errors, $message); }
    if ($password == '') { $message = 'Vyplňte heslo.'; array_push($errors, $message); }
    if (strlen($password) < 8 && strlen($password) > 0) {
        $message = "Krátké heslo. Musíte zadat alespoň 8 znaků!";
        array_push($errors, $message);
    }

    $existingUser = $usersDatabase->fetchbyEmail($email);

    if ($existingUser !== null) {
        $message = 'Email je již používán. Zkuste jiný.';
        array_push($errors, $message);
    }

    if (empty($errors)) {
        $usersDatabase->registerUser($role, $email, $hashedPassword, $name, $country, $zipCode, $city, $adress, $phone);
        header("Location: login.php");
        exit();
    }
}
?>