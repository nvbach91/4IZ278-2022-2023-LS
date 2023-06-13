<?php
include 'database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $response = [];

    if (empty($username) || empty($password)) {
        $response['error'] = 'Please fill all the fields.';
    } else {
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['user_id'];  
            $_SESSION['logged_in'] = true;
            $_SESSION['role'] = $user['role'];  
            $response['success'] = true;
        } else {
            $response['error'] = 'The username or password you entered was not valid.';
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
