<?php
require_once('./db/UsersDatabase.php');
session_start();
$userDB = new usersDatabase();
$email = $_POST['email'];
$password = $_POST['password'];
$checkUser = $userDB->fetchByEmailPass($email, $password);
if (!empty($checkUser)) {
    foreach ($checkUser as $checkedUser) {
        $_SESSION['user'] = [
            "email" => $checkedUser['email'],
            "name" => $checkedUser['name'],
            "surname" => $checkedUser['surname'],
            "phone" => $checkedUser['phone'],
            "adress" => $checkedUser['adress'],
            "postalCode" => $checkedUser['postalCode'],
        ];
    }
    header("Location:cart.php");
} else {
    $_SESSION['message'] = 'Login or password are incorrect';
    header("Location:login.php");
}
