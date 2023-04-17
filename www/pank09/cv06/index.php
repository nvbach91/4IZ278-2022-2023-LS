<?php
    require_once __DIR__ . '/classes/ProductsDB.php';
    require_once __DIR__ . '/classes/CategoriesDB.php';
    require_once __DIR__ . '/classes/SlidesDB.php';

    $categoryIsSet = isset($_GET['category_id']);

    $categoriesDatabase = new CategoriesDB;
    $categories = $categoriesDatabase->fetchAll();

    $productsDatabase = new ProductsDB;

    if ($categoryIsSet) {
        $products = $productsDatabase->fetchByCategory($_GET['category_id']);
    } else {
        $products = $productsDatabase->fetchAll();
    }

    $slidesDatabase = new SlidesDB;
    $slides = $slidesDatabase->fetchAll();
?>

<?php include "./components/base/head.php"; ?>

<div class="container">
    <?php include "./components/slider.php"; ?>
    <?php include "./components/categories.php"; ?>
    <?php include "./components/products.php"; ?>
</div>

<?php include "./components/base/foot.php"; ?>