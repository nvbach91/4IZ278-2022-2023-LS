<?php
require '../controller/product_controller.php';
require '../controller/user_required.php';

?>

<?php require __DIR__ . "/incl/header.php"; ?>
<div class="page">
    <div class="product_page_top">
        <img class="product_img" src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>" height="172" width="368">
        <div class="product_info">
            <p class="product_name"><?php echo $product['name'] ?></p>
            <p class="product_price">Price: <?php echo $product['price'] ?></p>
            <a href="" class="buy_button">
                <p>Buy</p>
            </a>
        </div>
    </div>
    <p class="product_description"><?php echo $product['description'] ?></p>
</div>
<?php require __DIR__ . "/incl/footer.php"; ?>