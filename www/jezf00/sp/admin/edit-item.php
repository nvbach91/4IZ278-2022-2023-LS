<?php

require_once '../categoriesDatabase.php';

$categoriesDb = new CategoriesDatabase();
$categories = $categoriesDb->fetchAll();

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

function getItemById($pdo, $id)
{
    $statement = $pdo->prepare('SELECT * FROM sp_products WHERE good_id = :good_id');
    $statement->execute(['good_id' => $id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

$error = '';

if (!empty($_POST) && !empty($_GET['good_id'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $good_id = $_GET['good_id'];
    $category_id = $_POST['category_id'];

    if (!is_numeric($price) || $price < 0) {
        $error = 'Invalid price. Please enter a valid positive number for the price.';
    } else {
        $categoryExists = false;
        foreach ($categories as $category) {
            if ($category['category_id'] == $category_id) {
                $categoryExists = true;
                break;
            }
        }

        if ($categoryExists) {
            $statement = $pdo->prepare('UPDATE sp_products SET name = :name, price = :price, description = :description, category_id = :category_id WHERE good_id = :good_id');
            $statement->execute(['name' => $name, 'price' => $price, 'description' => $description, 'good_id' => $good_id, 'category_id'=>$category_id]);

            header('Location: ./edit-item.php?good_id=' . $good_id . '&message=success');
            exit;
        } else {
            $error = 'Invalid category ID. Please enter a valid category ID.';
        }
    }
}

if (!empty($_GET['good_id'])) {
    $item = getItemById($pdo, $_GET['good_id']);
    if (!$item) {
        header('Location: ../index.php');
        exit;
    }
}
?>


<?php require '../header.php'; ?>

<body class="container">
<?php require '../navbar.php'; ?>
<h1>Edit Item</h1>
<?php if (!empty($_GET['message']) && $_GET['message'] == 'success') : ?>
    <p>Item has been successfully updated!</p>
<?php endif; ?>
<?php if ($error) : ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<?php if (isset($item)) : ?>
    <form action="./edit-item.php?good_id=<?php echo $item['good_id']; ?>" method="post">
        <br>
        <div class="input-group">
            <label for="category_id">Category ID:</label>
            <input type="text" name="category_id" id="category_id" value="<?php echo $item['category_id']; ?>" required>
            <div class="input-group-append">
                <button class="btn btn-info" type="button" id="infoBtn">i</button>
            </div>
        </div>
        <small id="categoryHint" class="form-text text-muted" style="display: none;">Hint: Enter a category ID. Available IDs and categories:<br><?php foreach ($categories as $category) {
                echo $category['category_id'] . ': ' . $category['name'] . '<br>';
            } ?></small>
        <br>
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
<script>
    var categoryHint = document.getElementById('categoryHint');
    var infoBtn = document.getElementById('infoBtn');
    var categoryIdField = document.getElementById('category_id');

    infoBtn.addEventListener('click', function() {
        if (categoryHint.style.display === 'none') {
            categoryHint.style.display = 'block';
        } else {
            categoryHint.style.display = 'none';
        }
    });
</script>
</body>

<?php require '../footer.php'; ?>
