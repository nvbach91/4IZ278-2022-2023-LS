<?php
$name = @$_POST['name'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie("name", $_POST['name'], time() + 3600);
    header('Location: index.php');
    exit();
}
?>
<?php require './src/header.php'; ?>
<main class="login">
    <div class = 'loginDiv'>
        <h1>Login</h1>
        <form method="POST" class = 'login'>
            <div class="form-group">
                <label for="name">Name</label>
                <br><input class="form-control" id="name" name="name" placeholder="Name">
            </div>
            <br>
            <button type="submit" class="loginButton">Submit</button>
        </form>
        <div style="margin-bottom: 600px"></div>
    </div>
</main>