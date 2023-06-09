<?php
require '../controller/user_required.php';
require '../controller/authorization.php';
require '../controller/product_controller.php';

authorize(2);

?>

<?php require __DIR__ . "/incl/header.php"; ?>
<form class="form" method="POST">
    <div>
        <label for="product_id">Product ID</label>
        <input type="text" id="product_id" name="product_id" placeholder="product_id" required autofocus>
    </div>
    <div>
        <label for="new_name">Product name</label>
        <input type="text" id="new_name" name="new_name" placeholder="product_name" required autofocus>
    </div>
    <div>
        <label for="price">Product price</label>
        <input type="text" id="price" name="price" placeholder="product_price" required>
    </div>
    <div>
        <label for="description">Product description</label>
        <input type="text" id="description" name="description" placeholder="product_description" required>
    </div>
    <div>
        <label for="image_link">Product image link</label>
        <input type="text" id="image_link" name="image_link" placeholder="product_image" required>
    </div>
    <br>
    <button type="submit">Add new product</button>
    <?php if (!empty($errors)) : ?>
        <div>
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</form>


<?php require __DIR__ . "/incl/footer.php"; ?>