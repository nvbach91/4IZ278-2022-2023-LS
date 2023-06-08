<?php
require_once "../model/users.php";

$users = fetchAllUsers();

@$user = fetchUserByEmail($_GET['email']);

if ($user == null) {
    $user['email'] = "Incorrect user email";
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    updateUser($user['email']);

    $current_user = fetchUserByEmail($_SESSION['user_email']);
    $_SESSION['user_email'] = $current_user['email'];
    $_SESSION['account_level'] = $current_user['account_level'];

    header("Location: user.php?email=" . $user['email']);
    exit();
}
