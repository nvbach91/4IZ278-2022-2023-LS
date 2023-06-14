<?php
require_once 'dbconfig.php';

if (!empty($_POST)) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $privilege = 1;
    $adress = $_POST['adress'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];

    $pdo = new PDO(
        'mysql:host=' . DB_HOST .
        ';dbname=' . DB_NAME .
        ';charset=utf8mb4',
        DB_USERNAME,
        DB_PASSWORD
    );

    $statement = $pdo->prepare('SELECT * FROM sp_users WHERE email = :email');
    $statement->execute(['email' => $email]);
    $existingUser = $statement->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        $error = 'Email already registered';
    } else {
        $statement = $pdo->prepare('INSERT INTO sp_users (email, name, password, privilege, adress, state, postalCode) VALUES (:email, :name, :password, :privilege, :adress, :state, :postalCode)');
        $statement->execute(['email' => $email, 'name' => $name, 'password' => $hashed_password, 'privilege' => $privilege, 'adress' => $adress, 'state' => $state, 'postalCode' => $postalCode]);

        header('Location: ./login.php');
        exit;
    }
}
?>

<?php require __DIR__ . '/header.php'; ?>

<body>
    <?php require __DIR__ . '/navbar.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="user-form">
                    <h3 class="mb-4">Register</h3>
                    <?php if (isset($error)) : ?>
                        <p class="text-danger"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <form action="./register.php" method="POST">
                        <div class="form-group">
                            <input class="form-control" type="email" placeholder="Enter email" name="email" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter name" pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed" name="name" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" placeholder="Enter password" name="password" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter address" name="adress" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter state" pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed" name="state" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter postal code" pattern="[0-9]+" title="Only numbers are allowed" name="postalCode" required>
                        </div>
                        <button class="btn btn-primary">Register</button>
                        <a href="./login.php">Go to login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<?php require __DIR__ . '/footer.php'; ?>
