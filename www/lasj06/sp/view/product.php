<?php
require '../controller/product_controller.php';
require '../controller/user_required.php';
require '../controller/authorization.php';

?>

<?php require __DIR__ . "/incl/header.php"; ?>
<div class="page">
    <div class="product_page_top">
        <img class="product_img" src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>" height="172" width="368">
        <div class="product_info">
            <p class="product_name"><?php echo $product['name'] ?></p>
            <p class="product_price">Price: <?php echo $product['price'] ?>€</p>
            <?php if (isset($_SESSION['account_level']) && $_SESSION['account_level'] > 0) : ?>
            <a href="../controller/buy_controller.php?product_id=<?php echo $product['product_id'] ?>" class="buy_button">
                <p>Buy</p>
            </a>
            <?php else : ?>
                <p>Please login to add products to your shopping cart.</p>
            <?php endif ?>
        </div>
    </div>
    <p class="product_description"><?php echo $product['description'] ?></p>
    <?php if (isset($_SESSION['account_level']) && ($_SESSION['account_level'] == 2 || $_SESSION['account_level'] == 3)) : ?>
    <a href="edit_product.php?product_id=<?php echo $product['product_id'] ?>">Edit product information.</a>
    <?php endif ?>
</div>
<?php require __DIR__ . "/incl/footer.php"; ?>