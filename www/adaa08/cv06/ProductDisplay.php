<?php require_once __DIR__ . '/db/ProductsDB.php'; ?>

<?php define('GLOBAL_CURRENCY', 'EUR'); ?>

<?php
$productsDB = new ProductsDB();

// Fetch all categories and products
$categories = $productsDB->fetchAllCategories();

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
if ($category_id !== null) {
    $products = $productsDB->fetchByCategory($category_id);
} else {
    $products = $productsDB->fetchAll();
}

// Fetch slides data
$slides = $productsDB->fetchSlides();
?>

<div class="slideshow-container">
    <?php foreach ($slides as $index => $slide): ?>
        <div class="mySlides fade <?php if ($index == 0) echo 'active'; ?>">
            <img src="<?php echo $slide['img']; ?>" alt="<?php echo $slide['title']; ?>" style="width:1%">
            <div class="text"><?php echo $slide['title']; ?></div>
        </div>
    <?php endforeach; ?>

    <a class="prev">&#10094;</a>
    <a class="next">&#10095;</a>
</div>

<br>


<div class="categories">
    <h3>Kategorie</h3>
    <?php foreach ($categories as $category): ?>
        <a href="https://esotemp.vse.cz/~adaa08/cv06/index.php?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a>
    <?php endforeach; ?>
</div>


<div class="row">
    <?php foreach($products as $product): ?>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 product">
            <a href="#">
                <img class="card-img-top product-image" src="<?php echo $product['img']; ?>" alt="mango-product-image">
            </a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="#"><?php echo $product['name']; ?></a>
                </h4>
                <h5><?php echo number_format($product['price'], 2), ' ', GLOBAL_CURRENCY; ?></h5>
                <p class="card-text">...</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
