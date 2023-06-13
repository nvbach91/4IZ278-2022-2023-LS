<?php
require 'authorization.php';
require 'admin-required.php';

$user_id = $_GET['user_id'];
$user = $usersDatabase->fetchById($user_id);

if(!$user){
    exit(404);
}

$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {

    $user_id = $user['user_id'];
    $role = htmlspecialchars(trim($_POST['role']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $user['password'];
    $name = htmlspecialchars(trim($_POST['name']));
    $country = htmlspecialchars(trim($_POST['country']));
    $zipCode = htmlspecialchars(trim($_POST['zip_code']));
    $city = htmlspecialchars(trim($_POST['city']));
    $adress = htmlspecialchars(trim($_POST['adress']));
    $phone = htmlspecialchars(trim($_POST['phone']));


    if ($email == '') { $message = 'Vyplňte email.'; array_push($errors, $message); }
    if ($role == '') { $message = 'Vyplňte roli.'; array_push($errors, $message); }
    if ($name == '') { $message = 'Vyplňte jméno a příjmení.'; array_push($errors, $message); }
    if ($country == '') { $message = 'Vyplňte stát bydliště.'; array_push($errors, $message); }
    if ($zipCode == '') { $message = 'Vyplňte poštovní směrovací číslo.'; array_push($errors, $message); }
    if ($city == '') { $message = 'Vyplňte obec.'; array_push($errors, $message); }
    if ($adress == '') { $message = 'Vyplňte ulici a č.p.'; array_push($errors, $message); }
    if ($phone == '') { $message = 'Vyplňte telefonní číslo.'; array_push($errors, $message); }

    $existingUser = $usersDatabase->fetchbyEmail($email);

    if ($existingUser['email'] !== $user['email']) {
        $message = 'Email je již používán. Zkuste jiný.';
        array_push($errors, $message);
    }

    if (empty($errors)) {
        $usersDatabase->updateUserByAdmin($user_id, $role, $email, $password, $name, $country, $zipCode, $city, $adress, $phone);
        header("Location: users.php");
        exit();
    }
}
