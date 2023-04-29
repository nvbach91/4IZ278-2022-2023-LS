<?php require_once './ProductsDatabase.php'; ?>
<?php require_once './CategoriesDatabase.php'; ?>
<?php

$productDatabase = new ProductDatabase();
$itemsCountPerPage = 4;
// $offset = 3;

if (isset($_GET['offset'])) {
  $offset = $_GET['offset'];
} else {
  $offset = 0;
}

if (isset($_GET['category_id'])) {
  $category_id = $_GET['category_id'];
  $products = $productDatabase->fetchRecordsByCategory($category_id, $itemsCountPerPage, $offset);
  // $products = $productDatabase->fetchByCategory($category_id);

  $totalRecords = $productDatabase->getRecordsCountForCategory($category_id);
  
} else {
  $products = $productDatabase->fetchRecords($itemsCountPerPage, $offset);
  $totalRecords = $productDatabase->getTotalRecords();
}

$paginationCount = ceil($totalRecords / $itemsCountPerPage);

$categoriesDatabase = new CategoriesDatabase();
$categories = $categoriesDatabase->fetchAll();


// var_dump($productDatabase->getTotalRecords());
// var_dump($productDatabase->getRecordsCountForCategory($category_id));
// var_dump($productDatabase->fetchRecords($itemsCountPerPage, $offset));
?>


<section class="py-5">
  <div>
    <ul id="page">
      <?php for ($i = 0; $i < $paginationCount; $i++) { ?>
        <li><a href="<?php echo isset($category_id) ? './?category_id=' . $category_id . '&offset=' . $i * $itemsCountPerPage : './?offset=' . $i * $itemsCountPerPage; ?>">
          <?php echo $i + 1; ?> 
        </a></li>
      <?php } ?>
    </ul>
  </div>
  <div class="container px-4 px-lg-5 mt-5">
      <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
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
            <div class="my-buttons">
              <form action="buy.php" method="POST">
                <input class="d-none" name="product_id" value="<?php echo $product['product_id']; ?>">
                <button class="btn btn-outline-dark card-button cart" type="submit">Add to cart</button>
              </form>
              <a class="btn btn-outline-dark card-button" href="./edit-item.php?product_id=<?php echo $product['product_id'];?>">
                  Edit
              </a>
              <a class="btn btn-outline-dark card-button" href="./delete-item.php?product_id=<?php echo $product['product_id'];?>">
                  Delete
              </a>
            </div>
            <!-- <a class="btn btn-outline-dark buy" href="./buy.php?product_id=<?php echo $product['product_id'];?>">Buy</a> -->
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
  </div>
</section>

