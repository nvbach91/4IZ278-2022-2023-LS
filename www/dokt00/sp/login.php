<?php
session_start();

// Replace the values below with your actual database credentials
$db_host = 'localhost';
$db_name = 'tea_shop';
$db_user = 'root';
$db_password = '';

// Create a connection to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user input from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Fetch the user data from the database
$sql = "SELECT user_id, password FROM Users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Verify the hashed password
    if (password_verify($password, $hashed_password)) {
        // Password is correct, create a session and redirect to a logged-in page
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: logged_in.html");
    } else {
        // Password is incorrect, redirect back to the main page with an error message
        header("Location: index.html?error=incorrect_password");
    }
} else {
    // Username not found, redirect back to the main page with an error message
    header("Location: index.html?error=user_not_found");
}

$stmt->close();
$conn->close();
?>
