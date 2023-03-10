<?php
$errors = [];
//Check if form is submitted 
if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $package = htmlspecialchars(trim($_POST['package']));
    $cardNum = htmlspecialchars(trim($_POST['cardNum']));

    //Validation whether the variable abide by our requirements
    if (strlen($fullname) == 0) {
        $message = 'Name must not be empty.';
        array_push($errors, $message);
    }
    if (!preg_match('/^[FMO]$/', $gender)) {
        $message = 'Gender must not be empty.';
        array_push($errors, $message);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Tady je chyba
        $message = 'Email is not valid.';
        array_push($errors, $message);
    }
    if (!preg_match('/^\d{9}$/', $phone)) {
        // Tady je chyba
        $message = 'Phone is not valid. Please refrain from using white spaces.';
        array_push($errors, $message);
    }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        $message = 'The avatar URL is invalid.';
        array_push($errors, $message);
    }
    if (strlen($package) == 0) {
        $message = 'Deck name must not be empty.';
        array_push($errors, $message);
    }
    if (!filter_var($cardNum, FILTER_VALIDATE_INT) || $cardNum <= 0) {
        $message = 'Number of cards must neither be empty nor lower than one.';
        array_push($errors, $message);
    }
    if (empty($errors)) {
    }
}