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
?>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
                foreach ($goods as $good) {
                    require('./includes/card.php');
                };
            ?>
        </div>
    </div>
</section>

<?php
require('./includes/footer.php');
?>