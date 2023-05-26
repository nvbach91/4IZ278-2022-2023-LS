<?php

require './utils.php';

$email = $_GET['email'];
$user = getUser($email);

if (!$user) {
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <main class="container">
        <h1>Profile</h1>
        <div>
            <p><?php echo $user['name']; ?></p>
            <p><?php echo $user['email']; ?></p>
        </div>
    </main>
</body>

</html>