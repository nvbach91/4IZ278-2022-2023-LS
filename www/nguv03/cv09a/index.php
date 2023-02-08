<?php require './db.php'; ?>
<?php


session_start();

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = $db->prepare("
        SELECT * FROM users WHERE email = :email LIMIT 1;
    ");
    $statement->execute([
        'email' => $email
    ]);
    $existing_user = $statement->fetchAll()[0];

    if (password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['user_id'];
        $_SESSION['email'] = $existing_user['email'];
        $_SESSION['user_privilege'] = $existing_user['privilege'];

        if ($existing_user['privilege'] >= 2) {
            header('Location: edit.php?id=1');
        } else {
            // presmerovat jinam;
        }


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
        <input name="username" placeholder="username">
        <input name="password" placeholder="password">
        <button>Log in</button>
    </form>
</body>
</html>