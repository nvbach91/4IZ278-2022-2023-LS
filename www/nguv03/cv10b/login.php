<?php 

if (isset($_COOKIE['username'])) {
    // check user
    $isAuthenticated = true;
    if ($isAuthenticated) {
        header('Location: ./index.php');
        exit;
    }
}

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // sanitize
    // check database
    // validate user, check password ...

    $isAuthenticated = true;
    if ($isAuthenticated) {
        setcookie(
            "username",
            $email,
            time() + 3600 * 24
        );
        session_start();
        header('Location: ./index.php');
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
    <form action="./login.php" method="POST">
        <input type="email" name="email">
        <input type="password" name="password">
        <button>Submig</button>
    </form>
</body>
</html>