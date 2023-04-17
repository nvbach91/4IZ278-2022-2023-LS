<?php 
require('./includes/header.php');

$errors = [];
$successes = [];

$submitedForm = !empty($_POST);
if ($submitedForm) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $packageName = htmlspecialchars(trim($_POST['packageName']));
    $cardAmount = htmlspecialchars(trim($_POST['cardAmount']));

    if (!$name) {
        array_push($errors, 'Please enter your name');
    }

    if (!in_array($gender, ['N', 'F', 'M'])) {
        array_push($errors, "Please choose your gender");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Please enter valid email");
    }

    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        array_push($errors, 'Please use a valid phone number');
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, 'Please use a valid URL for your avatar');
    }

    $intCardAmount = ctype_digit($cardAmount) ? intval($cardAmount) : null;
    if ($intCardAmount == null){
        array_push($errors, "Card amount must be a number");
    }else if ($cardAmount < 0) {
        array_push($errors, "Card amount must be more than 0");
    } else if ($cardAmount % 2 != 0) {
        array_push($errors, "Card amount must be odd");
    }

    if (!count($errors)) {
        array_push($successes, "You succesfully signed up!");
    }

}

require('./includes/body.php');
?>
