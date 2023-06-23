<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/Product.php';
require_once 'classes/Category.php';
require_once 'classes/Admin.php';
require_once 'classes/User.php';
require_once 'classes/Order.php';

$db = new Database();
$orderObj = new Order($db);
$productObj = new Product($db);
$userObj = new User($db);
$adminObj = new Admin($orderObj, $productObj, $userObj);

$categoryObj = new Category($db);
$categories = $categoryObj->getCategories();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $q_in_stock = $_POST['q_in_stock'];
    $category_id = $_POST['category_id'];

    if ($adminObj->addProduct($name, $price, $description, $q_in_stock, $category_id, $_FILES['photo'])) {
        header('Location: admin.php?message=ProductAdded');
        exit();
    } else {
        $error_message = "Error adding product.";
    }
}

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Add Product</title>
    <?php include 'meta.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>

<form action="add_product.php" method="post" enctype="multipart/form-data">

    <label for="name">Názov</label>
    <input type="text" name="name" placeholder="Product Name">

    <label for="price">Cena produktu (€)</label>
    <input type="number" name="price" placeholder="Price">

    <label for="description">Popis </label>
    <input type="text" name="description" placeholder="Description">

    <label for="q_in_stock">Počet (ks)</label>
    <input type="number" name="q_in_stock" placeholder="Quantity In Stock">

    <label for="category_id">Kategória</label>
    <select name="category_id">
        <?php foreach ($categories as $category): ?>
            <option value="<?= htmlspecialchars($category['category_id'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') ?></option>
        <?php endforeach; ?>
    </select>

    <label for="photo">Fotka</label>
    <input type="file" name="photo" required>

    <button type="submit">Pridať produkt</button>
</form>

<?php if(isset($error_message)): ?>
    <p>Error: <?= $error_message ?></p>
<?php endif; ?>

<?php include 'footer.php'; ?>

</body>
</html>