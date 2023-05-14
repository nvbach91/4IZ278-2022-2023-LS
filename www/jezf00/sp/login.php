<?php
require_once 'dbconfig.php';

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pdo = new PDO(
        'mysql:host=' . DB_HOST .
            ';dbname=' . DB_NAME .
            ';charset=utf8mb4',
        DB_USERNAME,
        DB_PASSWORD
    );

    $statement = $pdo->prepare('SELECT * FROM sp_users WHERE email = :email');
    $statement->execute(['email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user'] = $user;
        header('Location: ./index.php');
        exit;
    } else {
        $error = "Invalid email or password";
    }
}

?>

<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>
    <h3 class="mb-4">Login</h3>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="./login.php" method="POST">
        <div class="form-group w-25">
            <input class="form-control" type="email" placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group w-25">
            <input class="form-control" type="password" placeholder="Enter password" name="password" required>
        </div>
        <button class="btn btn-primary">Log in</button>
        <a href="./register.php">Go to registration</a>
    </form>
</body>

<?php require __DIR__ . '/footer.php'; ?>