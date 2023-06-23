<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['email'])) {
    die('Missing email parameter');
}

$email = $_GET['email'];

require_once 'classes/Database.php';
require_once 'classes/User.php';

$db = new Database();
$userObj = new User($db);

$user = $userObj->getUserByEmail($email);

if ($_SESSION['user_id'] === $user['user_id']) {
    header('Location: admin.php#users');
    exit();
}

if ($user) {
    $userObj->softDeleteUser($user['user_id']);
}

header('Location: admin.php#users');
exit();
