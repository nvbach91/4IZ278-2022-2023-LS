<?php

$errors = [];

if (isset($_POST) && !empty($_POST)) {
    $email = parseInput('email');
    $password = parseInput('password');
    $passwordCheck = parseInput('password_check');
    $name = parseInput('name');
    $gender = parseInput('gender');
    $phone =  parseInput('phone');
    $avatar = parseInput('avatar');
    $deck = parseInput('deck');
    $cardsCount = parseInput('cards_count');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, '*Invalid E-mail address');
    }

    if (!DatabaseService::checkConnection()) {
        array_push($errors, '**SERVER ERROR: Database does not exist**');
        return;
    }

    if ($type === LOGIN && authenticate($email, $password, $errors)) {
        header("Location: login.php?login=ok");
        exit();
    }

    if ($type === REGISTRATION && validateRegistration($email, $password, $passwordCheck, $name, $gender, $phone, $avatar, $deck, $cardsCount, $errors)) {
        if (DatabaseService::fetchUser($email)) {
            array_push($errors, '*User already exists');
        }

        if (empty($errors)) {
            DatabaseService::registerNewUser([$name, $email, $password, $phone, $gender, $deck, $cardsCount, $avatar]);

            header("Location: login.php?email=" . $email);
            exit();
        }
    }
}

function authenticate($email, $password, &$errors) : bool {
    $user = DatabaseService::fetchUser($email);

    if ($user === null || $password !== $user['password']) {
        array_push($errors, '*Login failed');
        return false;
    }

    return true;
}

function validateRegistration($email, $password, $passwordCheck, $name, $gender, $phone, $avatar, $deck, $cardsCount, &$errors): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, '*Invalid avatar URL');
    }

    if ($name === '') {
        array_push($errors, '*You must enter valid name');
    }

    if (!preg_match('/^[FMO]$/', $gender)) {
        array_push($errors, '*You must choose valid gender');
    }

    if (!preg_match('/^[0-9]{9}$/', $phone)) {
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

    // todo password complexity verification
    if (strlen($password) < 8) {
        array_push($errors, '*Invalid password');
    }

    if ($passwordCheck !== $password) {
        array_push($errors, '*Passwords don\'t match');
    }

    return empty($errors);
}

function parseInput($key)
{
    return isset($_POST[$key]) ?  htmlspecialchars(trim($_POST[$key])) : '';
}
