<?php

require_once '../../db/Database.php';
require_once '../../db/ProductDB.php';

$productDB = new ProductDB();
$products = $productDB->getAll();
?>

<?php if (!empty($products)) : ?>
    <section class="products">
        <?php $productCounter = 0; ?>
        <?php foreach ($products as $product) : ?>
            <?php if ($productCounter % 3 == 0 && $productCounter > 0) : ?>
    </section>
    <section class="products">
    <?php endif; ?>

    <div class="product">
        <img src="../../<?= htmlspecialchars($product["image_url"]); ?>" alt="<?= htmlspecialchars($product["name"]); ?>">
        <h3><span class="editable" contenteditable="true" data-product-id="<?= htmlspecialchars($product["product_id"]); ?>" data-column="name"><?= htmlspecialchars($product["name"]); ?></span></h3>
        <p><span class="editable" contenteditable="true" data-product-id="<?= htmlspecialchars($product["product_id"]); ?>" data-column="description"><?= htmlspecialchars($product["description"]); ?></span></p>
        <p><span class="editable" contenteditable="true" data-product-id="<?= htmlspecialchars($product["product_id"]); ?>" data-column="price"><?= htmlspecialchars($product["price"]); ?></span> Kč</p>
        <p><span class="editable" contenteditable="true" data-product-id="<?= htmlspecialchars($product["product_id"]); ?>" data-column="stock"><?= htmlspecialchars($product["stock"]); ?></span> Ks</p>
        <p><span class="editable" contenteditable="true" data-product-id="<?= htmlspecialchars($product["product_id"]); ?>" data-column="image_url"><?= htmlspecialchars($product["image_url"]); ?></span></p>
        <form method="POST">
            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product["product_id"]); ?>">
            <button class="delete-product" data-product-id="<?= htmlspecialchars($product["product_id"]); ?>" type="button">Delete product</button>
        </form>
    </div>

    <?php $productCounter++; ?>
<?php endforeach; ?>

<div class="product add-product">
        <p>+</p>
    </div>

<?php if ($productCounter % 3 != 0) : ?>
    </section>
<?php endif; ?>
<?php else : ?>
    <p>No products found</p>
<?php endif; ?>