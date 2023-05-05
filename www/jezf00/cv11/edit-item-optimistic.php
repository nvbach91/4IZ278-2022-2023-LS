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

function getItemById($pdo, $id)
{
    $statement = $pdo->prepare('SELECT * FROM cv06_products WHERE good_id = :good_id');
    $statement->execute(['good_id' => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function getCurrentTimestamp() {
    return time();
}

if (!empty($_POST) && !empty($_GET['good_id'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $good_id = $_GET['good_id'];
    $timestamp = $_SESSION['timestamp'];

    $item = getItemById($pdo, $good_id);
    if ($item['last_update'] > $timestamp) {
        $_SESSION['message'] = "The item has been updated by another user. Please refresh the page and try again.";
        header('Location: ./edit-item-optimistic.php?good_id=' . $good_id . '&message=failed');
        exit;
    }

    $statement = $pdo->prepare('UPDATE cv06_products SET name = :name, price = :price, description = :description, last_update = :last_update WHERE good_id = :good_id');
    $statement->execute(['name' => $name, 'price' => $price, 'description' => $description, 'last_update' => getCurrentTimestamp(), 'good_id' => $good_id]);

    header('Location: ./edit-item-optimistic.php?good_id=' . $good_id . '&message=success');
    exit;
}

if (!empty($_GET['good_id'])) {
    $item = getItemById($pdo, $_GET['good_id']);
    $_SESSION['timestamp'] = $item['last_update'];
}
?>


<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>
    <h1>Edit Item</h1>
    <?php if (!empty($_GET['message']) && $_GET['message'] == 'success') : ?>
        <p>Item has been successfully updated!</p>
    <?php endif; ?>
    <?php if (!empty($_GET['message']) && $_GET['message'] == 'failed') : ?>
        <p>Item was changed by another user during editation period and changes could not be saved!</p>
    <?php endif; ?>
    <?php if (isset($item)) : ?>
        <form action="./edit-item-optimistic.php?good_id=<?php echo $item['good_id']; ?>" method="post">
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
        <p>Item not found.</p>
    <?php endif; ?>
</body>

<?php require __DIR__ . '/footer.php'; ?>
