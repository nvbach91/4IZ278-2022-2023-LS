<?php
if (!isset($_SESSION)) {
	session_start();
}

// Clear session data
session_unset();
session_destroy();

// Redirect to main page
header("Location: index.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .logout-message {
            text-align: center;
            margin-top: 20px;
        }

        .logout-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Logout</h1>
    <div class="logout-message">
        <p>You have been successfully logged out.</p>
        <a href="login.php" class="logout-link">Login again</a>
    </div>
</body>
</html>