<?php
include 'database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    
    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['error_message'] = 'Please fill all the fields.';
        header('Location: register.html');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = 'Invalid email format.';
        header('Location: register.html');
        exit;
    }

    try {
        
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
        $stmt->execute([$username, $email]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['error_message'] = 'Username or email is already taken.';
            header('Location: register.html');
            exit;
        } else {
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
            $stmt->execute([$username, $hashed_password, $email]);

            
            $_SESSION['success_message'] = 'Registration successful! Please login.';
            header('Location: login.html');
            exit;
        }
    } catch (PDOException $e) {
        
        $_SESSION['error_message'] = 'Database error: ' . $e->getMessage();
        header('Location: register.html');
        exit;
    }
} else {
    header('Location: register.html');
    exit;
}
?>


