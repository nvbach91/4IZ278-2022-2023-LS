<?php 

$errors = [];

if(!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $deck = htmlspecialchars(trim($_POST['deck']));
    $count = htmlspecialchars(trim($_POST['count']));
    
    if ($name == '') { $message = 'Name is empty'; array_push($errors, $message); }

    if (!preg_match('/^[FMOI]$/', $gender)) { $message = "Invalid gender"; array_push($errors, $message); }

    if ($email == '') { $message = 'Email is empty'; array_push($errors, $message); }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $message = "Invalid E-mail"; array_push($errors, $message); }
    
    if ($phone == '') { $message = 'Phone is empty'; array_push($errors, $message); }
    
    if (!preg_match('/^[0-9]{9}$/', $phone)){ $message = 'Phone number is invalid'; array_push($errors, $message); }
    
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) { $message = "Invalid Avatar URL"; array_push($errors, $message); }

    if ($deck == '') { $message = 'Card deck name is empty'; array_push($errors, $message); }

    if (intval($count) <= 0) { $message = 'Invalid number of cards in deck'; array_push($errors, $message); }
}
?>