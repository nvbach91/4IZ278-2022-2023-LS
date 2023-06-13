<div class="best-seller">
  <h2 class="best-seller-title">Best Selling Product</h2>
  <?php
    
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_name = 'iPhone 13 Pro Max'");
    $stmt->execute();
    $product = $stmt->fetch();

    if ($product) {
      $image = $product['image'];
      $description = $product['description'];
      $price = $product['price'];
      $productId = $product['product_id'];

      // bestseller
      ?>
      <div class="product-bestseller">
        <img src="<?php echo $image; ?>" alt="Product Image">
        <div class="product-description">
          <h3><?php echo $product['product_name']; ?></h3>
          <p><?php echo $description; ?></p>
          <p>Price: $<?php echo $price; ?></p>
          <a href="product_details.php?category_id=1">
    <button>BUY NOW</button>
</a>

</a>

          
        </div>
      </div>
      <?php
    } else {
      echo 'Product not found.';
    }
  ?>
</div>