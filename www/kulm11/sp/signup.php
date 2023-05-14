<?php require_once "./UsersDatabase.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Signup</title>
</head>
<body>
    <header>
        <h1>Store Trek</h1>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./signup.php">Sign up</a></li>
                <li><a href="./login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="./signup.php" method="POST" id="signupForm">
            <label>E-mail:</label>
            <input type="email" name="email">
            <label>Password:</label>
            <input type="password" name="password">
            <label>Repeat password:</label>
            <input type="password" name="password2">
            <label>First name:</label>
            <input type="text" name="firstName">
            <label>Last name:</label>
            <input type="text" name="lastName">
            <label>City:</label>
            <input type="text" name="city">
            <label>Street:</label>
            <input type="text" name="street">
            <label>Building number:</label>
            <input type="number" name="buildingNo">
            <label>Zip code:</label>
            <input type="number" name="zipCode">
            <button>Signup</button>
        </form>
        <p><a href="./login.php">Already have an account? Click here</a></p>
    </main>
    <footer>

    </footer>
</body>
</html>