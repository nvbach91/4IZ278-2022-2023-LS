<?php
session_start();
require 'db.php';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // zajimavost: mysql porovnani retezcu je case insensitive, pokud dame select na NECO@DOMENA.COM, najde to i zaznam neco@domena.com
    // viz http://dev.mysql.com/doc/refman/5.0/en/case-sensitivity.html

    $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email LIMIT 1'); //LIMIT 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'email' => $email
    ]);
    

        $existing_user = $stmt->fetchAll()[0];

        if ($existing_user == null) {
            $_SESSION["error"] = "Unknown user";

            header('Location: login.php');
            exit('Invalid login');
        }

        if (password_verify($password, $existing_user['password'])) {
            $_SESSION['user_id'] = $existing_user['user_id'];
            $_SESSION['user_email'] = $existing_user['email'];
            $_SESSION['privilege'] = $existing_user['privilege'];
            
            setcookie('user', $email, time() + 3600);
            if (!isset($_SESSION["cart"])) {
                $_SESSION["cart"] = [];
            }
            header('Location: eshop.php');
            exit;
        } else {
            $_SESSION["error"] = "Wrong password";
    
            header('Location: login.php');
            exit('Invalid login');
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
    <?php if (isset($_SESSION["error"])):?>
        <p><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></p>
    <?php endif ?>
    <main class="container">
        <h1>PHP Shopping App</h1>
        <h2>Sign in</h2>
        <form action="login.php" class="form-signin" method="POST">
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
    </main>

</body>
</html>
