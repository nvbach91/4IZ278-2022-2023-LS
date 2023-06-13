<?php
session_start();

require_once 'db/UsersDB.php'; 

$username = $_POST['username'];
$password = $_POST['password'];

$userDB = new UsersDB();
$user = $userDB->getByUsername($username);

if ($user) {
    $hashed_password = $user['password'];

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $username;
        $_SESSION['isAdmin'] = $user['isAdmin'];
        echo json_encode(['success' => true, 'isAdmin' => $user['isAdmin']]);  
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
