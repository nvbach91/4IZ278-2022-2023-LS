<?php
require '../controller/user_required.php';
require '../controller/authorization.php';
require '../controller/product_controller.php';

authorize(2);

?>

<?php require __DIR__ . "/incl/header.php"; ?>
<form class="form" method="POST">
    <div>
        <label for="name">Product name</label>
        <input type="name" name="name" placeholder="product_name" value="<?php echo $product['name'] ?>" required autofocus>
    </div>
    <div>
        <label for="price">Product price</label>
        <input type="price" name="price" placeholder="product_price" value="<?php echo $product['price'] ?>" required>
    </div>
    <div>
        <label for="description">Product description</label>
        <input type="description" name="description" placeholder="product_description" value="<?php echo $product['description'] ?>" required>
    </div>
    <div>
        <label for="image_link">Product image link</label>
        <input type="image_link" name="image_link" placeholder="product_image" value="<?php echo $product['image'] ?>" required>
    </div>
    <br>
    <button type="submit">Change product information</button>
    <?php if (!empty($errors)) : ?>
        <div>
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</form>


<?php require __DIR__ . "/incl/footer.php"; ?>