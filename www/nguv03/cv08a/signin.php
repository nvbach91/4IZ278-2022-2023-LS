<?php require './db.php'; ?>

<?php
    session_start();

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $statement = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");

        $statement->execute([
            'email' => $email,
        ]);

        $existingUser = $statement->fetchAll()[0];

        if (password_verify($password, $existingUser['password'])) {
            $_SESSION['user_id'] = $existingUser['user_id'];
            $_SESSION['user_email'] = $existingUser['email'];
            $_SESSION['user_privilege'] = $existingUser['privilege'];

            header('Location: index.php');
        } else {
            exit('Wrong credentials');
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
    <form method="POST">
        <input name="email" placeholder="email">
        <input name="password" placeholder="password">
        <button>Submit</button>
    </form>
</body>
</html>