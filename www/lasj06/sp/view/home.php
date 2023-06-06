<?php
require '../controller/home_controller.php';
require '../controller/search_controller.php';
require '../controller/user_required.php';
?>

<?php require __DIR__ . "/incl/header.php"; ?>

<div class="content">
    <form class="category_select" method="POST">
        <?php foreach ($allCategories as $category) : ?>
            <div class="category">
                <input type="checkbox" name="category[]" value="<?php echo $category['category'] ?>">
                <label for="category[]"><?php echo $category['category'] ?></label>
            </div>
        <?php endforeach ?>
        <button class="category_button" type="submit">Search Games containing all categories</button>
    </form>

    <div class="products">
        <?php if (!empty($productsByCategories)) : ?>
            <?php foreach ($productsByCategories as $product) : ?>
                <div class="product">
                    <p><?php echo $product['name'] ?></p>
                    <a href='product.php?product_id=<?php echo $product['product_id']; ?>'><img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>" height="172" width="368"></a>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <?php foreach ($products as $product) : ?>
                <div class="product">
                    <p><?php echo $product['name'] ?></p>
                    <a href='product.php?product_id=<?php echo $product['product_id']; ?>'><img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>" height="172" width="368"></a>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>


<?php require __DIR__ . "/incl/footer.php";
