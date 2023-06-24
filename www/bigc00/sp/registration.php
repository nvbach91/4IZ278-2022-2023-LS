
<?php
if (!isset($_SESSION)) {
	session_start();
}

require_once 'db.php';
require_once 'functions.php';


// Form submission handling
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Check if the email already exists in the database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $error = "Email již existuje";
    } else {
        // Insert user data into the database
        $query = "INSERT INTO users (name, surname, email, password, phoneNumber) VALUES ('$name', '$surname', '$email', '$password', '$phone')";

        if (mysqli_query($connection, $query)) {
            $_SESSION['username'] = $email;
            sendRegistrationEmail($email);
            header("Location: index.php"); // Replace 'dashboard.php' with the desired page
            exit();
        } else {
            $error = "Došlo k chybě, zkuste to prosím znovu.";
        }
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
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        h2 {
            text-align: center;
        }
        
        form {
            width: 300px;
            margin: 0 auto;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        input[type="text"],
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
    </style>
</head>
<body>
<a href="index.php" class="cart-link">Home</a>
    <h2>User Registration</h2>
    <?php if (isset($error)) : ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="surname">Surname:</label>
        <input type="text" name="surname" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" required><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>


