<?php
require_once './CategoriesDB.php';
$categoryIsSet = isset($_GET['category_id']);

$categoriesDB = new CategoriesDB;
$categories = $categoriesDB->fetchAll();

$productsDB = new ProductsDB;

if ($categoryIsSet) {
    $products = $productsDB->fetchByCategory($_GET['category_id']);
} else {
    $products = $productsDB->fetchAll();
}

$slidesDB = new SlidesDB;
$slides = $slidesDB->fetchAll();



?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
    <title>CV6</title>
</head>
<div class="container">
    <?php include './slides.php'; ?>
    <?php include './categories.php'; ?>
    <?php include './products.php'; ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</div>

</html>