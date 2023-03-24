<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php

$productsDB = new ProductsDB();
if (isset($_GET['category_id'])) {
  $products = $productsDB->fetchByCategory($_GET['category_id']);
} else {
  $products = $productsDB->fetchAll();
}

// $products = [
//   ['name' => 'Tommy Atkins', 'price' => 49.9, 'img' => 'https://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg'],
//   ['name' => 'Ataulfo', 'price' => 60.9, 'img' => 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg'],
//   ['name' => 'Kent', 'price' => 47.9, 'img' => 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg'],
//   ['name' => 'Haden', 'price' => 51.9, 'img' => 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg'],
//   ['name' => 'Keitt', 'price' => 39.9, 'img' => 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg'],
//   ['name' => 'Francine', 'price' => 59.9, 'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStvS-QHWIlsLILy-fIIGXcxlb2jUIrXNDjKXs4eLbSJt4gJKLu'],
// ];
?>

<div class="row">
  <?php foreach($products as $product): ?>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100 product">
      <a href="#"><img class="card-img-top product-image" src="<?php echo $product['img']; ?>" alt="mango-product-image"></a>
      <div class="card-body">
        <h4 class="card-title"><a href="#"><?php echo $product['name']; ?></a></h4>
        <h5><?php echo number_format($product['price'], 2), ' ', GLOBAL_CURRENCY; ?></h5>
        <p class="card-text"><?php echo 'Lorem ipsum dolor amet sungo motte balu kareso loqes'; ?></p>
      </div>
      <div class="card-footer">
        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>