<?php
require('./includes/header.php');
require('./db/ProductsDB.php');
require('./db/CategoriesDB.php');

$caregoriesDB = new CategoriesDB();
$categories = $caregoriesDB -> fetchAll();
require('./includes/categories.php');

$productsDB = new ProductsDB();
if (isset($_GET['category_id'])) {
    $goods = $productsDB -> fetchByCategory($_GET['category_id']);
} else {
    $goods = $productsDB -> fetchAll();
}

$withDiscount = [];
$allGoods = $productsDB -> fetchAll();
foreach ($allGoods as $good) {
    if ($good['discount'] >= 0) {
        array_push($withDiscount, $good);
    }
} 
require('./includes/slider.php');
require('./includes/cards.php');
require('./includes/footer.php');
?>