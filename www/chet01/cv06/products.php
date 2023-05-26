<?php require_once './ProductsDB.php' ?>

<?php
$productsDb = new ProductsDB();

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $products = $productsDb->fetchByCategory($category_id);
} else {
    $products = $productsDb->fetchAll();
}
?>


<div class="row">
    <?php foreach ($products as $p) : ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 item-card">
                <a><img class="card-img-top item-image" src="<?php echo $p['img']; ?>"></a>
                <div class="card-body">
                    <h4 class="card-title"><a href="#"><?php echo $p['name']; ?></a></h4>
                    <h5><?php echo $p['price'] . ' Kc' ?></h5>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>