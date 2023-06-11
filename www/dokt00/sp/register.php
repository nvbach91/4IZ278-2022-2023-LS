<?php
require_once 'db/Database.php';
require_once 'db/UserDB.php';

$usersDB = new UsersDB();

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];

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
    // registration successful
    echo 'success';
} else {
    // registration failed
    echo "Error: User could not be registered.";
}
?>
