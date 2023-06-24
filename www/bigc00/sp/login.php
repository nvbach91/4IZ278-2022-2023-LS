<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once 'db.php';
require_once 'vendor/autoload.php';
require_once 'google-callback.php';

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: profile.php");
    exit();
}

$authUrl = $client->createAuthUrl();


// Form submission handling
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = "SELECT *
FROM users 
WHERE email='$email' AND users.password='$password'";
    $result = mysqli_query($connection, $query);

    // Check if a row exists in the result set
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['admin'] == $row['id']) {
            $_SESSION['admin'] = true;  // User is an admin
        } else {
            $_SESSION['admin'] = false;
        }
        $_SESSION['username'] = $email;
        header("Location: profile.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}


mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        input[type="submit"]:hover {
            background-color: #1a1a1a;
        }

        p.error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }

        .register-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <a href="index.php" class="cart-link">Home</a>
    <h2>User Login</h2>
    <?php if (isset($error)) : ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
    <?php
    echo '<a href="' . $authUrl . '"  class="register-link">Login with Google</a>';
    ?>
    <a href="registration.php" class="register-link">Register</a>
</body>

</script>

</html>