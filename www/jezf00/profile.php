<?php

session_start();
require_once 'auth.php';
requireLogin();

require_once 'dbconfig.php';
$pdo = new PDO(
    'mysql:host=' . DB_HOST .
    ';dbname=' . DB_NAME .
    ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);

$statement = $pdo->prepare("SELECT * FROM sp_users WHERE email = :email");
$statement->execute([':email'=>  $_SESSION['user']['email']]); 
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $adress = $_POST['adress'];


        $statement = $pdo->prepare("UPDATE sp_users SET email = :email, password = :password, name = :name, state = :state, postalCode = :postalCode, adress = :adress WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $hashed_password);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':state', $state);
        $statement->bindParam(':postalCode', $postalCode);
        $statement->bindParam(':adress', $adress);
        $statement->bindParam(':name', $name);
        $statement->execute();


        $statement = $pdo->prepare("SELECT * FROM sp_users WHERE name = :name");
        $statement->bindParam(':name', $name);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

}

?>

<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>
    <h2>User Information</h2>
    
    <form method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $username; ?>">
        </div>
        <div class="form-group">
            <label for="password">Password <i>/insert your new password/</i></label>
            <input type="password" class="form-control" id="password" name="password" value="">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>">
        </div>
        <div class="form-group">
            <label for="state">State</label>
            <input type="text" class="form-control" id="state" name="state" value="<?php echo $user['state']; ?>">
        </div>
        <div class="form-group">
            <label for="postalCode">Postal Code</label>
            <input type="text" class="form-control" id="postalCode" name="postalCode" value="<?php echo $user['postalCode']; ?>">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="adress" name="adress" value="<?php echo $user['adress']; ?>">
        </div>
        <?php if ($user['state'] === 'Fill this data' || $user['adress'] === 'Fill this data' || $user['postalCode'] === '123'): ?>
            <div class="alert alert-warning" role="alert">
                Please update your state, postal code, and address.
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="./order-history.php"> View order history</a>
    </form>
</body>
<?php require __DIR__ . '/footer.php'; ?>
