<?php include './app/header.php';?>
<?php require './database/ProductsDB.php';?>
<?php require './database/CategoriesDB.php';?>
<?php require './database/SlidesDB.php';?>
<?php

$productsDatabase = new ProductsDatabase();
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $products = $productsDatabase->fetchByCategory($category_id);
} else {
    $products = $productsDatabase->fetchAll();
}

$categoriesDatabase = new CategoriesDatabase();
$categories = $categoriesDatabase->fetchAll();

$slidesDB = new SlidesDatabase();
$slides = $slidesDB->fetchAll();

?>

    <main class="max-w-4xl mx-auto">
        <section id="products" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Banana Categories</h2>
                <div class="flex flex-col justify-between items-center my-5 space-y-2 text-2xl text-slate-900 dark:text-white">
                <?php include './app/CategoryDisplay.php' ?>
                </div>
                <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Products</h2>

                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    <!-- product -->
                    <?php include './app/ProductDisplay.php' ?>
                </div>
            </div>
        </section>
        <section id="carousel" class="p-6 my-12 scroll-mt-20 widescreen:section-min-height tallscreen:section-min-height">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-6 text-slate-900 dark:text-white">Best bananas</h2>
            <?php include './app/SlideDisplay.php' ?>
            
        </section>
    </main>
    
    <?php include './app/footer.php';
    ?>