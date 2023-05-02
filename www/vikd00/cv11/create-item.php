<?php

session_start();
require_once 'auth.php';
requireLogin();
requirePrivilege(2);

require_once 'dbconfig.php';
$pdo = new PDO(
    'mysql:host=' . DB_HOST .
        ';dbname=' . DB_NAME .
        ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);

if (!empty($_POST)) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $img = $_POST['img'];

    $stmt = $pdo->prepare('INSERT INTO cv09_goods (name, price, description, img) VALUES (:name, :price, :description, :img)');
    $stmt->execute(['name' => $name, 'price' => $price, 'description' => $description, 'img' => $img]);

    header('Location: ./create-item.php?message=success');
    exit;
}
?>

<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>
    <h1>Create Item</h1>
    <?php if (!empty($_GET['message']) && $_GET['message'] == 'success') : ?>
        <p>Item has been successfully created!</p>
    <?php endif; ?>
    <form action="./create-item.php" method="post">
        <label for="name">Name:</label>
        <input class="form-control" type="text" name="name" id="name" required>
        <br>
        <label for="price">Price:</label>
        <input class="form-control" type="text" name="price" id="price" required>
        <br>
        <label for="description">Description:</label>
        <textarea class="form-control" name="description" id="description" required></textarea>
        <br>
        <label for="img">Image URL:</label>
        <input class="form-control" type="text" name="img" id="img" required>
        <br>
        <button class="btn btn-outline-primary" type="submit">Create Item</button>
    </form>
</body>

<?php require __DIR__ . '/footer.php'; ?>