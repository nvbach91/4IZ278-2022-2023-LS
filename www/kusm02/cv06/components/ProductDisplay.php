<?php require_once __DIR__ . '/../db/ProductDatabase.php'; ?>
<?php

/*$productsDB = new ProductDatabase();
if (isset($_GET['category_id'])) {
  $products = $productsDB->fetchByCategory($_GET['category_id']);
} else {
  $products = $productsDB->fetchAll();
}*/

$productsDB = new ProductDatabase();
$products = $productsDB->fetchAll();
const GLOBAL_CURRENCY = 'Kč';
?>

<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 product">
    <a href="#">
        <img class="card-img-top product-image" src="<?php echo $product['img']; ?>" alt="mango-product-image">
    </a>
      <div class="card-body">
        <h4 class="card-title">
            <a href="#"><?php echo $product['name']; ?>
        </a>
    </h4>
        <h5><?php echo number_format($product['price'], 2), ' ', GLOBAL_CURRENCY; ?></h5>
        <p class="card-text"><?php echo 'Buy the product, please. We really beg you.'; ?></p>
      </div>
      <div class="card-footer">
        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>