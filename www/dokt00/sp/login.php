<?php
session_start();

// db
$db_host = 'localhost';
$db_name = 'tea_shop';
$db_user = 'root';
$db_password = '';

// connection to database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// user input from the form
$username = $_POST['username'];
$password = $_POST['password'];

// user data from the database
$sql = "SELECT user_id, password FROM Users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // verifying hashed password
    if (password_verify($password, $hashed_password)) {
        // password is correct
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $username;
        header("Location: pages/logged_in/logged_in.php");
    } else {
        // password incorrect
        header("Location: index.html?error=incorrect_password");
    }
    
} else {
    // username not found
    header("Location: index.html?error=user_not_found");
}

$stmt->close();
$conn->close();
?>
