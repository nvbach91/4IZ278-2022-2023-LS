<?php
$db_host = 'localhost';
$db_name = 'tea_shop';
$db_user = 'root';
$db_password = '';

//connection to db
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//user input from the form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];

// hashing passw security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// inserting the user data into the database
$sql = "INSERT INTO Users (username, email, password, first_name, last_name, phone) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $username, $email, $hashed_password, $first_name, $last_name, $phone);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // registration successful
    header("Location: index.html");
} else {
    // registration failed
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
