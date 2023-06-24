<?php

    if (!isset($_SESSION)) {
	session_start();
}

require_once 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['username'];

$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($connection, $query);

// if (!$result || mysqli_num_rows($result) == 0) {
//     header("Location: index.php");
//     exit();
// }

$_SESSION['userData'] = mysqli_fetch_assoc($result);
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .profile-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-heading {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-info {
            margin-bottom: 10px;
        }

        .profile-info label {
            font-weight: bold;
        }

        .logout-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<a href="index.php" class="cart-link">Home</a>
    <div class="profile-container">
        <h2 class="profile-heading">User Profile</h2>
        <div class="profile-info">
            <label>Name:</label>
            <p><?php echo $_SESSION['userData']['name']; ?></p>
        </div>
        <div class="profile-info">
            <label>Surname:</label>
            <p><?php echo $_SESSION['userData']['surname']; ?></p>
        </div>
        <div class="profile-info">
            <label>Email:</label>
            <p><?php echo $_SESSION['userData']['email']; ?></p>
        </div>
        <div class="profile-info">
            <label>Phone:</label>
            <p><?php echo $_SESSION['userData']['phoneNumber']; ?></p>
        </div>
        <a href="logout.php" class="logout-link">Logout</a>
    </div>
</body>

</html>