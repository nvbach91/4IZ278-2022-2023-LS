<?php
include 'database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    if (empty($username) || empty($email) || empty($password)) {
        die('Please fill all the fields.');
    }

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format.');
    }

    
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
    $stmt->execute([$username, $email]);
    $user = $stmt->fetch();

    if ($user) {
        die('Username or email is already taken.');
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
        $stmt->execute([$username, $hashed_password, $email]);

       
        header('Location: login.html');
        exit;
    }
} else {
    
    header('Location: register.html');
    exit;
}
?>

