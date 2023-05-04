<?php
if (!isset($_COOKIE['name'])) {
    header('Location: login.php');
    exit();
}
$name = @$_COOKIE['name'];
?>
<?php require './src/header.php'; ?>
<main class="login">
    <div class = 'loginDiv'>
        <h1>Login</h1>
        <form method="POST" class = 'loginForm' action = 'logout.php'>
            <div class="form-group">
                <h2>Name</h2>
                <p><?php echo $name; ?></p>
            </div>
            <button type="submit" class="loginButton">Log out</button>
        </form>
        <div style="margin-bottom: 600px"></div>
    </div>
</main>