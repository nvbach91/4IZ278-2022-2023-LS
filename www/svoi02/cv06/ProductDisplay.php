<?php require_once './ProductsDatabase.php'; ?>
<?php require_once './CategoriesDatabase.php'; ?>
<?php

$productDatabase = new ProductDatabase();
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $products = $productDatabase->fetchByCategory($category_id);
} else {
    $products = $productDatabase->fetchAll();
}

$categoriesDatabase = new CategoriesDatabase();
$categories = $categoriesDatabase->fetchAll();


?>
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
        <h5><?php echo number_format($product['price'], 2), ' ', "$"; ?></h5>
        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, aliquam. Explicabo, iste eaque? Placeat libero quidem reprehenderit.</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
