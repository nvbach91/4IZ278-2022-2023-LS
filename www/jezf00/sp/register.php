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

    $statement = $pdo->prepare('INSERT INTO sp_users (email, name, password, privilege, adress, state, postalCode) VALUES (:email, :name, :password, :privilege, :adress, :state, :postalCode)');
    $statement->execute(['email' => $email, 'name' => $name, 'password' => $hashed_password, 'privilege' => $privilege, 'adress'=> $adress, 'state' => $state, 'postalCode' => $postalCode]);

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
            <input class="form-control" type="name" placeholder="Enter name" name="name" required>
        </div>
        <div class="form-group w-25">
            <input class="form-control" type="password" placeholder="Enter password" name="password" required>
        </div>
        
        <div class="form-group w-25">
            <input class="form-control" type="adress" placeholder="Enter adress" name="adress" required>
        </div>
        
        <div class="form-group w-25">
            <input class="form-control" type="state" placeholder="Enter state" name="state" required>
        </div>
        
        <div class="form-group w-25">
            <input class="form-control" type="postalCode" placeholder="Enter postal code" name="postalCode" required>
        </div>
        <button class="btn btn-primary">Register</button>
        <a href="./login.php">Go to login</a>
    </form>
</body>

<?php require __DIR__ . '/footer.php'; ?>