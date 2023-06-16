<?php require_once '../dbconfig.php'; ?>
<?php require_once '../auth.php'; ?>

<?php
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
        if (isset($_SESSION['saved_cart'])) {
            $_SESSION['cart'] = $_SESSION['saved_cart'];
            unset($_SESSION['saved_cart']);
        } else {
            $_SESSION['cart'] = []; 
        }
        header('Location: ../index.php');
        exit;
    } else {
        $error = 'Invalid email or password';
    }
}
?>

<?php require '../header.php'; ?>

<body>
    <?php require '../navbar.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="user-form">
                    <h3 class="mb-4">Login</h3>
                    <?php if (isset($error)) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endif; ?>
                    <form action="./login.php" method="POST">
                        <div class="form-group">
                            <input class="form-control" type="email" placeholder="Enter email" name="email" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" placeholder="Enter password" name="password" required>
                        </div>
                        <button class="btn btn-primary">Log in</button>
                        <a href="register.php">Go to registration</a>
                    </form>
                    <div class="text-center">
                        <form action="../fb-login.php">
                        <button class="btn btn-primary">Log in with Facebook</button>
                    </form>
    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<?php require '../footer.php'; ?>
