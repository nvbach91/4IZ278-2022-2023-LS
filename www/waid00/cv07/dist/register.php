<?php
session_start();
include('database.php');

if (isset($_POST['submit'])) {
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
        $stmt = $pdo->prepare("SELECT * FROM `users` WHERE name = ?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();

        if ($result) {
            $error = "Username already exists.";
        } else {
            $stmt = $pdo->prepare("SELECT MAX(user_id) AS max_user_id FROM `users`");
            $stmt->execute();
            $result = $stmt->fetch();
            $max_user_id = $result['max_user_id'];
            $new_user_id = $max_user_id + 1;

            $stmt = $pdo->prepare("INSERT INTO `users` (user_id, name, privilege) VALUES (?, ?, 0)");
            $stmt->execute([$new_user_id, $username]);
            $_SESSION['login'] = $username;
            $_SESSION['id'] = $new_user_id;
            header('Location: index.php');
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
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>
    <form method="post">
        <input type="text" name='username' placeholder="Enter username...">
        <input type="submit" name='submit' value="Register">
        <p style="color: red;"><?php echo isset($error) ? $error : ''; ?></p>
    </form>
    <p>Already have an account? <a href="index.php">Login</a></p>
</body>

</html>