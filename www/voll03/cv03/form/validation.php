<?php

$errors = [];

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = isset($_POST['gender']) ? htmlspecialchars(trim($_POST['gender'])) : '';
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $deck = htmlspecialchars(trim($_POST['deck']));
    $cardsCount = htmlspecialchars(trim($_POST['cardsCount']));

    if ($name === '') {
        array_push($errors, '*You must enter valid name');
    }

    if (!preg_match('/^[FMO]$/', $gender)) {
        array_push($errors, '*You must choose valid gender');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, '*Invalid E-mail address');
    }

    if (!preg_match('/^[0-9]{9}$/',$phone)) {
        array_push($errors, '*Invalid phone number');
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, '*Invalid avatar URL');
    }

    if ($deck === '') {
        array_push($errors, '*You must specify the name of your deck');
    }

    if (intval($cardsCount) <= 0) {
        array_push($errors, '*Empty or invalid number of cards');
    }

    if (empty($errors)) {
        // success
        
        //$_SESSION['avatar_url'] = $avatar;
        //header("Location: index.php?saved=ok");
        //exit();
    }
}
