<?php
session_start();

if (isset($_POST['submit'])) {
    if (!empty($_POST['username'])) {
        $userId = $_SESSION['user_id'] ?? 0;
        $userId++;
        $_SESSION['user_id'] = $userId;
        $_SESSION['login'] = $_POST['username'];
        header('Location: index.php');
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
    <title>Settings</title>
</head>

<body>
    <p>Your current username: <?php echo $_SESSION['login']; ?> </p>

    <form method="post">
        <label for="username">Enter a new username</label><br>
        <input type="text" name='username' value="<?php echo isset($_SESSION['login']) ? $_SESSION['login'] : ''; ?>" placeholder="username...">
        <input type="submit" name='submit' value="submit">
        <?php if (isset($_POST['submit']) && empty($_POST['username'])) { ?>
            <p style="color: red;">Please enter a valid username.</p>
        <?php } ?>
    </form>
</body>

</html>