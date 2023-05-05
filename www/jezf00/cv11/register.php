<?php
require_once 'dbconfig.php';

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $privilege = 1; // na serveru eso je nastaven na 3 aby bolo jednoduchšie sa dostať k editu

    $pdo = new PDO(
        'mysql:host=' . DB_HOST .
            ';dbname=' . DB_NAME .
            ';charset=utf8mb4',
        DB_USERNAME,
        DB_PASSWORD
    );

    $statement = $pdo->prepare('INSERT INTO cv10_users (email, password, privilege) VALUES (:email, :password, :privilege)');
    $statement->execute(['email' => $email, 'password' => $hashed_password, 'privilege' => $privilege]);

    header('Location: ./login.php');
    exit;
}

?>

<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>
    <h3 class="mb-4">Register</h3>
    <form action="./register.php" method="POST">
        <div class="form-group w-25">
            <input class="form-control" type="email" placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group w-25">
            <input class="form-control" type="password" placeholder="Enter password" name="password" required>
        </div>
        <button class="btn btn-primary">Register</button>
    </form>
</body>

<?php require __DIR__ . '/footer.php'; ?>