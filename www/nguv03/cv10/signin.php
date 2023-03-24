<?php
session_start();
require 'db.php';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // zajimavost: mysql porovnani retezcu je case insensitive, pokud dame select na NECO@DOMENA.COM, najde to i zaznam neco@domena.com
    // viz http://dev.mysql.com/doc/refman/5.0/en/case-sensitivity.html

    $stmt = $db->prepare('SELECT * FROM cv10_users WHERE email = :email LIMIT 1'); //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'email' => $email
    ]);
    $existing_user = @$stmt->fetchAll()[0];

    if (password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['user_id'];
        $_SESSION['user_email'] = $existing_user['email'];

        header('Location: index.php');
        exit;
    } else {
        header('HTTP/1.1 401 Unauthorized');
        exit('Invalid login');
    }
}
?>


<?php require __DIR__ . '/incl/header.php' ?>
<main class="container">
    <h1>PHP Shopping App</h1>
    <h2>Sign in</h2>
    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        </div>

        <div class="form-label-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
    </form>
    <a href="signup.php">Don't have an account yet? Go to sign up!</a>
</main>

<div style="margin-bottom: 600px"></div>

<?php require __DIR__ . '/incl/footer.php' ?>