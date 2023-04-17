<?php


if (!empty($_POST)) {
    $username = $_POST['username'];

    // check user in database...
    // then set cookie
    
    session_start();
    setcookie('username', $username, time() + 3600);
    header('Location: ./profile.php');
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
    <h1>PHP Session</h1>
    <form action="./session.php" method="POST">
        <input name="username">
        <button>Log in</button>
    </form>
</body>
</html>