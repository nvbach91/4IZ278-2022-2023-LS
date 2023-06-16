<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

require_once '../../db/Database.php';
require_once '../../db/UsersDB.php';

$usersDB = new UsersDB();
$alertMessages = [];

$info = $usersDB->getById($_SESSION['user_id']);

$oldPassword = $_POST['old_password'];
$newPassword = $_POST['new_password'];

$password_pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

if (!password_verify($oldPassword, $info['password'])) {
    echo json_encode(['error' => 'Old password is incorrect.']);
    exit;
}

if (!preg_match($password_pattern, $newPassword)) {
    echo json_encode(['error' => 'New password is invalid. Password must have 8 characters or more, at least one uppercase letter, one lowercase letter and one number.']);
    exit;
}

$hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

$isUpdated = $usersDB->updatePasswordHash($_SESSION['user_id'], $hashed_password);
if ($isUpdated) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Unable to update password']);
}

?>