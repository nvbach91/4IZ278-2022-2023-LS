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

$error = '';

if (!empty($_POST)) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $img = $_POST['img'];
    $category_id= $_POST['category_id'];

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
            
            $statement = $pdo->query('SELECT MAX(good_id) AS max_good_id FROM sp_products');
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $maxGoodId = $row['max_good_id'];

           
            $goodId = $maxGoodId ? $maxGoodId + 100 : 100;

            $stmt = $pdo->prepare('INSERT INTO sp_products (good_id, name, price, description, img, category_id) VALUES (:good_id, :name, :price, :description, :img, :category_id)');
            $stmt->execute(['good_id' => $goodId, 'name' => $name, 'price' => $price, 'description' => $description, 'img' => $img, 'category_id' => $category_id]);

            header('Location: ./create-item.php?message=success');
            exit;
        } else {
            $error = 'Invalid category ID. Please enter a valid category ID.';
        }
    }
}
?>



<?php require '../header.php'; ?>

<body class="container">
    <?php require '../navbar.php'; ?>
    <h1>Create Item</h1>
    <?php if (!empty($_GET['message']) && $_GET['message'] == 'success') : ?>
        <p>Item has been successfully created!</p>
    <?php endif; ?>
    <?php if ($error) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="./create-item.php" method="post">
        <label for="category_id">Category ID:</label>
        <div class="input-group">
            <input class="form-control" type="text" name="category_id" id="category_id" required>
            <div class="input-group-append">
                <button class="btn btn-info" type="button" id="infoBtn">i</button>
            </div>
        </div>
        <small id="categoryHint" class="form-text text-muted" style="display: none;">Hint: Enter a category ID. Available IDs and categories:<br><?php foreach ($categories as $category) {
            echo $category['category_id'] . ': ' . $category['name'] . '<br>';
        } ?></small>
        <br>
        <label for="name">Name:</label>
        <input class="form-control" type="text" name="name" id="name" required>
        <br>
        <label for="price">Price:</label>
        <input class="form-control" type="text" name="price" id="price" min="0" required>
        <br>
        <label for="description">Description:</label>
        <textarea class="form-control" name="description" id="description" required></textarea>
        <br>
        <label for="img">Image URL:</label>
        <input class="form-control" type="text" name="img" id="img" required>
        <br>
        <button class="btn btn-outline-primary" type="submit">Create Item</button>
    </form>
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
