<?php

if (!empty($_POST)) {
    session_start();
    $username = htmlspecialchars(trim($_POST['name']));;

    setcookie('username', $username, time() + 3600);

    header('Location: ./index.php');
    exit;
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
    <h1>Login</h1>
    <form action="./login.php" method="POST">
        <input name="name">
        <button>Login</button>
    </form>
   
</body>
</html>