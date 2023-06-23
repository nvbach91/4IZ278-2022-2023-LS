<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['product_id'])) {
    die('Missing product_id parameter');
}

$product_id = $_GET['product_id'];

require_once 'classes/Database.php';
require_once 'classes/Product.php';
require_once 'classes/Category.php';

$db = new Database();
$productObj = new Product($db);
$categoryObj = new Category($db);

$categories = $categoryObj->getCategories();
$product = $productObj->getProductById($product_id);
?>


<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Edit Product</title>
    <?php include 'meta.php'; ?>
</head>
<body>

<?php include 'header.php'; ?>

<form action="update_product.php" method="post" enctype="multipart/form-data">
    
        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id, ENT_QUOTES, 'UTF-8') ?>">

        <label for="name">Názov produktu</label>
        <input type="text" name="name" placeholder="Názov produktu" value="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>">

        <label for="price">Nová cena produktu(€)</label>
        <input type="number" name="price" placeholder="Cena" value="<?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8') ?>">

        <label for="description">Nový popis produktu</label>
        <input type="text" name="description" placeholder="Popis" value="<?= htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8') ?>">

        <label for="q_in_stock">Pridaný počet kusov(ks)</label>
        <input type="number" name="q_in_stock" placeholder="Nový počet kusov" value="<?= htmlspecialchars($product['q_in_stock'], ENT_QUOTES, 'UTF-8') ?>">

    <label for="category_id">Zmena kategórie</label>
    <select name="category_id">
        <?php foreach ($categories as $category): ?>
        <option value="<?= htmlspecialchars($category['category_id'], ENT_QUOTES, 'UTF-8') ?>" <?= $category['category_id'] == $product['categories_category_id'] ? 'selected' : '' ?>><?= htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') ?></option>
        <?php endforeach; ?>
    </select>
    
    <label for="photo">Zmena fotografie</label>
    <input type="file" name="photo">
    <input type="hidden" name="old_photo" value="<?= htmlspecialchars($product['photo'], ENT_QUOTES, 'UTF-8') ?>">


    <button type="submit">Upraviť produkt</button>
</form>

<?php include 'footer.php'; ?>

</body>
</html>