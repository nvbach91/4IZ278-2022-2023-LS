<?php
session_start();
include('database.php');

if (isset($_POST['submit'])) {
    if (!empty($_POST['username'])) {
        $_SESSION['login'] = $_POST['username'];

        $stmt = $pdo->prepare("SELECT * FROM `users` WHERE name = ?");
        $stmt->execute([$_SESSION['login']]);
        $user = $stmt->fetch();
        if ($user) {
            $_SESSION['id'] = $user['user_id'];
            header('Location: index.php');
        } else {
            $error = "User not found.";
        }
    } else {
        $error = "Please enter a valid username.";
    }
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
    <form method="post">
        <input type="text" name='username' placeholder="username...">
        <input type="submit" name='submit' value="submit">
        <p style="color: red;"><?php echo isset($error) ? $error : ''; ?></p>
    </form>
    <a href="register.php">register</a>
</body>

</html>