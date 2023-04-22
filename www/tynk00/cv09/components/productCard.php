<div class="col-lg-3 col-sm-11">
  <div class="card shadow-lg mb-4">
    <img src="<?php echo $product['image']; ?>" class="card-img-top fixed-height" alt="Product Image">
    <div class="card-body text-center">
      <h5 class="card-title"><?php echo $product['name']; ?></h5>
      <hr>
      <a href="home.php?category_id=<?php echo $product['category']; ?>">
        <p class="card-text fs-5"><span class="badge rounded-pill text-bg-primary"><?php echo $categoriesDatabase->getCategoryName($product['category']); ?></span></p>
      </a>
      <hr>
      <p class="card-text"><?php echo $product['price']; ?> Kč</p>
      <a href="product.php?id=<?php echo $product['product_id'] ?>" class="btn btn-secondary w-100 mb-2">Zobrazit detaily</a>

      <form action="../cartModel.php" method="post" class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Počet</span>
        </div>
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
        <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
        <input type="number" class="form-control" name="quantity" value="1" min="1" max="10">
        <input type="hidden" name="action" value="add">
        <button class="btn btn-primary" type="submit"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
      </form>


    </div>
  </div>
</div>