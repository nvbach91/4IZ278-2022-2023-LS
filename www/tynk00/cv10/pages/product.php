<?php
session_start();
require_once('../database/loadData.php');

include('../components/header.php');



$product = isset($_GET['id']) ? $productsDatabase->getProductById($_GET['id']) : null;


?>


<?php if ($product != null) : ?>

  <div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
    </div>
    <div class="card-body text-dark">
      <div class="row">
        <div class="col-md-6">
          <img src="<?php echo $product['image']; ?>" class="img-fluid" alt="Product Image">
        </div>
        <div class="col-md-6">
          <h2><?php echo $product['name']; ?></h2>
          <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">
          <p class="card-text fs-5">Kategorie:
            <a href="home.php?category_id=<?php echo $product['category']; ?>">
              <span class="badge text-bg-dark"><?php echo $categoriesDatabase->getCategoryName($product['category']); ?></span>
            </a>
          </p>
          <p>Cena: <?php echo $product['price']; ?> Kč</p>
          <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">
          <p>
          <?php echo ($product['description'] != '') ? $product['description'] : 'Tento produkt nemá žádný popisek'; ?>

          </p>


          <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">

          <form method="post" action="productEditor.php">
            <input type="hidden" name="product_id" value="<?php echo $product["product_id"] ?>">
            <input type="hidden" name="name" value="<?php echo $product["name"] ?>">
            <input type="hidden" name="category" value="<?php echo $product["category"] ?>">
            <input type="hidden" name="price" value="<?php echo $product["price"] ?>">
            <input type="hidden" name="image" value="<?php echo $product["image"] ?>">
            <input type="hidden" name="description" value="<?php echo $product["description"] ?>">
            <input type="hidden" name="edit" value="1">
            <button class="btn btn-primary">Add to Cart</button>
            <button class="btn btn-warning ms-1" type="submit"><i class="fa fa-pencil" aria-hidden="true"></i> Upravit</button>
          </form>

        </div>
      </div>
    </div>
  </div>
<?php endif; ?>



<?php

include('../components/footer.php');

?>