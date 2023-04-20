<?php

require_once('../database/loadData.php');

include('../components/header.php');



$product = isset($_GET['id']) ? $productsDatabase->getProductById($_GET['id']) : null;


?>


<?php if($product != null) : ?>

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
        <p>Kategorie: <?php echo $categoriesDatabase->getCategoryName($product['category']); ?></p>
        <p>Cena: <?php echo $product['price']; ?> Kč</p>
        <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">
        <button class="btn btn-primary">Add to Cart</button>
      </div>
    </div>
    </div>
</div>
<?php endif; ?>



<?php

include('../components/footer.php');

?>