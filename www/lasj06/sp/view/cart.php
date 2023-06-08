<?php
require '../controller/user_required.php';
require '../controller/authorization.php';
require '../controller/cart_controller.php';

authorize(1);

?>

<?php require __DIR__ . "/incl/header.php"; ?>
<div class="cart_products">
    <?php foreach ($products as $product) : ?>
        <div class="cart_line">
            <img src="<?php echo $product['image'] ?>" height="34.4" width="73.6">
            <a href="product.php?product_id=<?php echo $product['product_id'] ?>">
                <p class="cart_line_item"><?php echo $product['name'] ?></p>
            </a>
            <p class="cart_line_item"><?php echo $product['price'] ?>€</p>
            <a href="../controller/remove_controller.php?product_id=<?php echo $product['product_id'] ?>" class="cart_line_item">
                <p>Remove item</p>
            </a>
        </div>
    <?php endforeach ?>
    <?php if ($sum != 0) : ?>
    <div class="cart_info">
        <p class="cart_line_item">Total: <?php echo $sum ?>€</p>
        <a href="order.php" class="cart_line_item">
            <p>Continue to order</p>
        </a>
    </div>
    <?php else : ?>
    <div class="cart_info">
        <p class="cart_line_item">Your Shopping Cart is currently empty. You can add products through their respective pages.</p>
    </div>
    <?php endif ?>
    <?php require __DIR__ . "/incl/footer.php"; ?>