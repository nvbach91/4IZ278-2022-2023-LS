<?php
session_start();
if (!isset($_COOKIE['username'])) {
    header('Location: ./session.php');
    exit;
}

$username = $_COOKIE['username'];


var_dump($_SESSION);

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
    <h1>You are logged in</h1>
    <a href="./logout.php">Logout</a>
    <h2><?php echo $username; ?></h2>

    
    <p>
        <a href="./buy.php?good_id=1">Buy this product (id: 1O)</a>
    </p>
</body>
</html>