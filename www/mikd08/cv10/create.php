<?php
session_start();
require_once 'db.php';

if (!empty($_POST)) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $img = $_POST['img'];

    $stmt = $pdo->prepare('INSERT INTO cv09_goods (name, price, description, img) VALUES (:name, :price, :description, :img)');
    $stmt->execute(['name' => $name, 'price' => $price, 'description' => $description, 'img' => $img]);

    header('Location: ./create.php');
    exit;
}
?>

<?php require 'header.php'; ?>


    <h1>Create Item</h1>
    <?php if (!empty($_GET['message']) && $_GET['message'] == 'success') : ?>
        <p>Item has been successfully created!</p>
    <?php endif; ?>
    <form action="./create.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <br>
        <label for="img">Image URL:</label>
        <input type="text" name="img" id="img" required>
        <br>
        <button type="submit">Create Item</button>
    </form>
</body>

<?php require 'footer.php'; ?>