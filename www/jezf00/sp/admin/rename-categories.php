<?php
session_start();
require_once '../auth.php';
requireLogin();
requirePrivilege(2);

require_once '../dbconfig.php';
$pdo = new PDO(
    'mysql:host=' . DB_HOST .
    ';dbname=' . DB_NAME .
    ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);

function getCategoryById($pdo, $id)
{
    $statement = $pdo->prepare('SELECT * FROM sp_categories WHERE category_id = :category_id');
    $statement->execute(['category_id' => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

$category_id = $_GET['category_id'];

if (!empty($_POST) && isset($category_id)) {
    $name = htmlspecialchars($_POST['name']);

    $statement = $pdo->prepare('UPDATE sp_categories SET name = :name WHERE category_id = :category_id');
    $statement->execute(['name' => $name, 'category_id' => $category_id]);

    header('Location: ./rename-categories.php?category_id=' . $category_id . '&message=success');
    exit;
}

$category = getCategoryById($pdo, $category_id);
if (!$category) {
    header('Location: ../index.php');
    exit;
}
?>

<?php require '../header.php'; ?>

<body class="container">
    <?php require '../navbar.php'; ?>
    <h1>Rename category</h1>
    <?php if (!empty($_GET['message']) && $_GET['message'] == 'success') : ?>
        <p>Category has been successfully updated!</p>
    <?php endif; ?>
    <?php if (isset($category)) : ?>
        <form action="./rename-categories.php?category_id=<?php echo $category['category_id']; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
            <button class="btn btn-outline-primary" type="submit">Update category</button>
        </form>
    <?php else : ?>
        <p>Category not found.</p>
    <?php endif; ?>
</body>

<?php require '../footer.php'; ?>
