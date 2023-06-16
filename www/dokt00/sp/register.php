<?php
session_start();

require_once 'db/Database.php';
require_once 'db/UsersDB.php';

$usersDB = new UsersDB();
$alertMessages = [];

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];


$username_pattern = "/^[a-zA-Z0-9]*$/";
$email_pattern = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/";
$password_pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";  
$name_pattern = "/^[a-zA-ZěščřžýáíéĚŠČŘŽÝÁÍÉ]*$/";
$phone_pattern = "/^[0-9\-+\s()]*$/u";

if (!preg_match($username_pattern, $username)) {
    array_push($alertMessages, 'Invalid username');
}

if (!preg_match($email_pattern, $email)) {
    array_push($alertMessages, 'Invalid email');
}

if (!preg_match($password_pattern, $password)) {
    array_push($alertMessages, 'Invalid password');
}

if (!preg_match($name_pattern, $first_name)) {
    array_push($alertMessages, 'Invalid first name');
}

if (!preg_match($name_pattern, $last_name)) {
    array_push($alertMessages, 'Invalid last name');
}

if (!preg_match($phone_pattern, $phone)) {
    array_push($alertMessages, 'Invalid phone number');
}

$usernameExists = $usersDB->getByUsername($username);
if ($usernameExists) {
    array_push($alertMessages, 'Username already in use');
}

$emailExists = $usersDB->getByEmail($email);
if ($emailExists) {
    array_push($alertMessages, 'Email already in use');
}

if (!empty($alertMessages)) {
    echo implode('<br/>', $alertMessages);
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$userData = [
    'username' => $username,
    'email' => $email,
    'password' => $hashed_password,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'phone' => $phone
];

$userId = $usersDB->insert($userData);

if ($userId) {
    echo 'success';
} else {
    echo 'Error: User could not be registered.';
}
exit();
?>