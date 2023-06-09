<?php
require '../controller/user_required.php';
require '../controller/cart_controller.php';
require '../controller/authorization.php';

authorize(1);

?>

<?php require __DIR__ . "/incl/header.php"; ?>
<form class="form" method="POST">
    <?php foreach ($products as $product) : ?>
        <div class="cart_line">
            <p class="cart_line_item"><?php echo $product['name'] ?></p>
            <p class="cart_line_item"><?php echo $product['price'] ?>€</p>
        </div>
    <?php endforeach ?>
    <div class="cart_line">
        <form>
            <label class="cart_line_item" for="address">Delivery Address</label>
            <input class="order_address" type="address" name="address" placeholder="address" required>

    </div>
    <div class="cart_line">
        <p class="cart_line_item">Total Order: <?php echo $sum ?>€</p>
        <button type="submit" class="cart_line_item">Confirm Order</button>
    </div>
</form>
</form>


<?php require __DIR__ . "/incl/footer.php"; ?>