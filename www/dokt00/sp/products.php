<?php

require_once 'db/Database.php';
require_once 'db/ProductDB.php';

$productDB = new ProductDB();
$products = $productDB->getAll();
?>

<?php if (!empty($products)): ?>
    <section class="products">
        <?php $productCounter = 0; ?>
        <?php foreach ($products as $product): ?>
            <?php if ($productCounter % 3 == 0 && $productCounter > 0): ?>
                </section>
                <section class="products">
            <?php endif; ?>

            <div class="product">
                <img src="<?= htmlspecialchars($product["image_url"]); ?>" alt="<?= htmlspecialchars($product["name"]); ?>">
                <h3><?= htmlspecialchars($product["name"]); ?></h3>
                <p><?= htmlspecialchars($product["price"]); ?> Kč</p>
                <form method="POST">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product["product_id"]); ?>">
                    <button class="add-to-cart" data-product-id="<?= htmlspecialchars($product["product_id"]); ?>" type="button">Add to Cart</button>
                </form>
            </div>

            <?php $productCounter++; ?>
        <?php endforeach; ?>

        <?php if ($productCounter % 3 != 0): ?>
            </section>
        <?php endif; ?>
<?php else: ?>
    <p>No products found</p>
<?php endif; ?>
