<?php
include 'database.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if (empty($username) || empty($password)) {
        die('Please fill all the fields.');
    }

    
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    
    if ($user && password_verify($password, $user['password'])) {  
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = time();

        
        header('location: index.php');
        exit;
    } else {
        
        echo 'The username or password you entered was not valid.';
    }
} else {
    
    header('location: login.html');
    exit;
}
?>
