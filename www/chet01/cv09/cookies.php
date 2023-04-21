<?php
setcookie('email', '', time());
if (isset($_COOKIE['email'])) {
    $email = $_COOKIE['email'];
    $auth = true;
    if ($auth) {
        header('Location: index.php');
        exit;
    }
}

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $auth = true;
    if ($auth) {
        setcookie('email', $email, time() + 360 * 24);
        session_start();
        header('Location: index.php');
        exit;
    }
}

var_dump($_COOKIE);

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
        <input name="email" placeholder="email">
        <input name="password" placeholder="password">
        <button type="submit">sumbit</button>
    </form>
</body>

</html>