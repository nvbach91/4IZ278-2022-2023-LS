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

function getItemById($pdo, $good_id)
{
    $statement = $pdo->prepare('SELECT * FROM cv06_products WHERE good_id = :good_id');
    $statement->execute(['good_id' => $good_id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function getCurrentTimestamp()
{
    return time();
}

function lockItem($pdo, $good_id, $user_id)
{
    $user_id = (int)$user_id;
    $statement = $pdo->prepare('UPDATE cv06_products SET edit_start_time = :edit_start_time, editing_user_id = :editing_user_id WHERE good_id = :good_id');
    $statement->execute(['edit_start_time' => getCurrentTimestamp(), 'editing_user_id' => $user_id, 'good_id' => $good_id]);
}

function unlockItem($pdo, $good_id)
{
    $statement = $pdo->prepare('UPDATE cv06_products SET edit_start_time = NULL, editing_user_id = NULL WHERE good_id = :good_id');
    $statement->execute(['good_id' => $good_id]);
}

if (!empty($_POST) && !empty($_GET['good_id'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $good_id = $_GET['good_id'];

    $statement = $pdo->prepare('UPDATE cv06_products SET name = :name, price = :price, description = :description WHERE good_id = :good_id');
    $statement->execute(['name' => $name, 'price' => $price, 'description' => $description, 'good_id' => $good_id]);

    header('Location: ./edit-item-pessimistic.php?good_id=' . $good_id . '&message=success');
    unlockItem($pdo, $good_id);
    exit;
}

if (!empty($_GET['good_id'])) {
    $item = getItemById($pdo, $_GET['good_id']);

    if ($item['editing_user_id'] !== null && $item['editing_user_id'] != $_SESSION['user'] && getCurrentTimestamp() - $item['edit_start_time'] < 300) {
        $_SESSION['message'] = "The item is currently being edited by another user. Please try again later.";
        header('Location: ./index.php');
        exit;
    } else {
        lockItem($pdo, $item['good_id'], $_SESSION['user']);
    }
}

if (!empty($_GET['good_id']) && !empty($_GET['action']) && $_GET['action'] == 'cancel') {
    unlockItem($pdo, $_GET['good_id']);
    header('Location: ./index.php');
    exit;
}
?>

<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>
    <h1>Edit Item</h1>
    <?php if (!empty($_GET['message']) && $_GET['message'] == 'success') : ?>
        <p>Item has been successfully updated!</p>
    <?php endif; ?>
    <?php if (isset($item)) : ?>
        <form action="./edit-item-pessimistic.php?good_id=<?php echo $item['good_id']; ?>" method="post">
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
        <a href="./edit-item-pessimistic.php?good_id=<?php echo $item['good_id']; ?>&action=cancel" class="btn btn-outline-danger">Cancel</a>
    <?php else : ?>
        <p>Item not found.</p>
    <?php endif; ?>
</body>

<?php require __DIR__ . '/footer.php'; ?>