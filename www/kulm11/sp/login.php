<?php require_once "./UsersDatabase.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Login</title>
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
        <form action="./login.php" method="POST" id="loginForm">
            <label>E-mail:</label>
            <input type="email" name="email">
            <label>Password:</label>
            <input type="password" name="password">
            <button>Login</button>
        </form>
        <p><a href="./signup.php">Don't have an account? Click here</a></p>
    </main>
    <footer>

    </footer>
</body>
</html>