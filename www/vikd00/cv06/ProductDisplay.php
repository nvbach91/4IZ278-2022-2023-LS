<?php require_once './ProductsDatabase.php' ?>

<?php
$productsDb = new ProductsDatabase();

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $products = $productsDb->fetchByCategory($category_id);
} else {
    $products = $productsDb->fetchAll();
}
?>


<div class="row">
    <?php foreach ($products as $item) : ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 item-card">
                <a href="#"><img class="card-img-top item-image" src="<?php echo $item['img']; ?>"></a>
                <div class="card-body">
                    <h4 class="card-title"><a href="#"><?php echo $item['name']; ?></a></h4>
                    <h5><?php echo $item['price'] . ' €' ?></h5>
                    <p class="card-text"><?php echo 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque'; ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>