<?php
require 'authorization.php';


$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {

    $user_id = $current_user['user_id'];
    $role = $current_user['role'];
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $name = htmlspecialchars(trim($_POST['name']));
    $country = htmlspecialchars(trim($_POST['country']));
    $zipCode = htmlspecialchars(trim($_POST['zip_code']));
    $city = htmlspecialchars(trim($_POST['city']));
    $adress = htmlspecialchars(trim($_POST['adress']));
    $phone = htmlspecialchars(trim($_POST['phone']));


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

    if ($existingUser['email'] !== $current_user['email']) {
        $message = 'Email je již používán. Zkuste jiný.';
        array_push($errors, $message);
    }

    if (empty($errors)) {
        $usersDatabase->updateUser($user_id, $role, $email, $hashedPassword, $name, $country, $zipCode, $city, $adress, $phone);
        header("Location: user.php");
        exit();
    }
}
