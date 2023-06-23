<?php
require_once('./db/UsersDatabase.php');
session_start();
$userDB = new usersDatabase();
$email = $_POST['email'];
$password = $_POST['password'];
$checkUser = $userDB->fetchByEmailPass($email, $password);
if (!empty($checkUser)) {
    foreach ($checkUser as $checkedUser) {
        if (isset($checkedUser['admin_id'])) {
            $_SESSION['user'] = [
                "admin_id"=>$checkedUser['admin_id'],
                "user_id" => $checkedUser['user_id'],
                "email" => $checkedUser['email'],
                "name" => $checkedUser['name'],
                "surname" => $checkedUser['surname'],
                "phone" => $checkedUser['phone'],
                "adress" => $checkedUser['adress'],
                "postalCode" => $checkedUser['postalCode'],
            ];
            $_SESSION['admin'][]=$_SESSION['user'];
        } else {
            $_SESSION['user'] = [
                "user_id" => $checkedUser['user_id'],
                "email" => $checkedUser['email'],
                "name" => $checkedUser['name'],
                "surname" => $checkedUser['surname'],
                "phone" => $checkedUser['phone'],
                "adress" => $checkedUser['adress'],
                "postalCode" => $checkedUser['postalCode'],
            ];
        }
    }
    header("Location:cart.php");
} else {
    $_SESSION['message'] = 'Login or password are incorrect';
    header("Location:login.php");
}
