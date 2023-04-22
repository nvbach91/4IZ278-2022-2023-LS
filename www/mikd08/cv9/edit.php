<?php
require_once 'db.php';

if (!empty($_GET['good_id'])) {
    $statement = $pdo->prepare('SELECT * FROM cv09_goods WHERE good_id = :good_id');
    $statement->execute(['good_id' => $_GET['good_id']]);
    $item = $statement->fetch(PDO::FETCH_ASSOC);
}

if (!empty($_POST) && !empty($_GET['good_id'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $good_id = $_GET['good_id'];

    $statement = $pdo->prepare('UPDATE cv09_goods SET name = :name, price = :price, description = :description WHERE good_id = :good_id');
    $statement->execute(['name' => $name, 'price' => $price, 'description' => $description, 'good_id' => $good_id]);

    header('Location: index.php?');
    exit;
}

?>


<?php require 'header.php'; ?>

<body>
    <h1>Edit</h1>
    <?php if (isset($item)) : ?>
        <form action="./edit.php?good_id=<?php echo $item['good_id']; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $item['name']; ?>" required>
            <br>
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" value="<?php echo $item['price']; ?>" required>
            <br>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo $item['description']; ?></textarea>
            <br>
            <button class="btn btn-outline-primary" type="submit">Update Item</button>
        </form>
    <?php else : ?>
        <p style="color:red; font-size: 3em;">Unknown item.</p>
    <?php endif ?>
</body>

<?php require 'footer.php'; ?>