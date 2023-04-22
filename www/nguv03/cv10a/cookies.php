<?php
if (isset($_COOKIE['email'])) {
    $email = $_COOKIE['email'];
    // check database again
    $isAuthenticated = true;
    if ($isAuthenticated) {
        // lze prodlouzit cookie
        header('Location: index.php');
        exit;
    }

}

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // check database
    $isAuthenticated = true;
    if ($isAuthenticated) {
        setcookie(
            "email",
            $email,
            time() + 3600 * 24
        );
        session_start();
        header('Location: index.php');
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./cookies.php" method="POST">
        <h2>Login form</h2>
        <input name="email" placeholder="EMAIL">
        <input name="password" placeholder="PASSWORD" type="password">
        <button>Submit</button>
    </form>
</body>
</html>