<?php require_once './UsersDatabase.php'; ?>
<?php

$db = new UsersDatabase();
session_start();
$errors = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $user = $db->login($email, $password);

    if (!empty($user)) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['auth_level'] = $user['auth_level'];
    
    
        header('Location: ./index.php');
        exit;
    }
    

    array_push($errors, 'Wrong login credentials');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/login.css" rel="stylesheet" />
</head>
<body>
    <h2>Login</h2>
    <div class="login">
    <?php if (!empty($errors)): ?>
        <div class="error-container">
            <?php foreach($errors as $error): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
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
        <div class="txt">
            <div>Don't have an account? </div>
            <a href="./registration.php" class="btn btn-lg btn-primary btn-block text-uppercase">Register here</a>
        </div>
    </div>
</body>
</html>