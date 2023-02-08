<?php require './db.php'; ?>
<?php

session_start();

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // if (strlen($password) < 8) {

    // }
    // validace vstupu, pomoci regex

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $statement = $db->prepare("
        INSERT INTO users(email, password, privilege) 
            VALUES (:email, :password, 0)");
    $statement->execute([
        'email' => $email,
        'password' => $hashedPassword,
    ]);

    header('Location: signin.php');
    // echo $hashedPassword;
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
    <form method="POST">
        <input name="email" placeholder="email">
        <input name="password" placeholder="password">
        <button>Submit</button>
    </form>
</body>
</html>