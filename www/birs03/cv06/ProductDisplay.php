<?php require_once './ProductsDatabase.php';?>
<?php

$productsDatabase = new ProductsDatabase();
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $products = $productsDatabase->fetchByCategory($category_id);
}else{
    $products = $productsDatabase->fetchAll();
}

?>

<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 product">
      <a href="#">
        <img class="card-img-top product-image" src="<?php echo $product['image']; ?>" alt="mango-product-image">
      </a>
      <div class="card-body">
        <h4 class="card-title">
          <a href="#"><?php echo $product['name']; ?></a>
        </h4>
        <h5><?php echo number_format($product['price'], 2), ' €'; ?></h5>
        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla aliquet, nisi vitae facilisis malesuada, ante purus efficitur ex, eu vestibulum tortor metus a risus.</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>