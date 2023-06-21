<?php
require_once './index.php';
?>
<form method="post" action="">
    Type Product Name to get info: <input type="text" name="product_name">
    <input type="submit" value="Get info">
</form>
<form method="post" action="deleteProdAPI.php">
    Type Product ID to delete product: <input type="text" name="product_id">
    <input type="submit" value="Delete">
</form>
<?php

if (isset($_POST["product_name"])) {
    $products = $productDB->fetchByName($_POST['product_name']);
    foreach ($products as $product) {
?>
        <div class='containerOurProducts'>
            <div class="productBox">
                <div class="productImg">
                    <img src='<?php echo $product['img_link'] ?>'>
                </div>
                <div class='productTitle'>
                    <h2><?php echo $product['product_name'];
                        echo '(ID:' . $product['product_id'] . ')' ?></h2>
                </div>
                <div class='productPrice'>
                    <h2><?php
                        echo 'Discount: ' . $product['discount'];
                        echo ' PRICE:' . $product['price'];
                        ?> kČ</h2>
                    <h2>Category:<?php echo $product['category_id'];
                                    ?></h2>
                </div>

            </div>
            <div class="Box">
                <form action="updateAPI.php" method="post">
                    <h2>Update Product</h2>
                    <div class="inputbox">
                        <input type="text" name="oldProdID" placeholder="Old product ID">
                        <label for="">Old product ID</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="newImgLink" placeholder="New Image link">
                        <label for="">New Image link</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="title" placeholder="New title">
                        <label for="">New title</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="newPrice" placeholder="New price">
                        <label for="">New price</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="newDiscount" placeholder="New discount">
                        <label for="">New discount</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="newCategoryId" placeholder="New category">
                        <label for="">New category</label>
                    </div>
                    <input type="submit">
                </form>

            </div>
        </div>
<?php }
} ?>
<div class='containerOurProducts'>
    <div class="Box">
        <form action="createAPI.php" method="post">
            <h2>Create Product</h2>
            <div class="inputbox">
                <input type="text" name="product_id" placeholder="Product ID">
                <label for="">Product ID</label>
            </div>
            <div class="inputbox">
                <input type="text" name="product_name" placeholder="Product name">
                <label for="">Product name</label>
            </div>
            <div class="inputbox">
                <input type="text" name="price" placeholder="Price">
                <label for="">Price</label>
            </div>
            <div class="inputbox">
                <input type="text" name="category_id" placeholder="Category id">
                <label for="">Category id</label>
            </div>
            <div class="inputbox">
                <input type="text" name="discount" placeholder="Discount">
                <label for="">Discount</label>
            </div>
            <div class="inputbox">
                <input type="text" name="img_link" placeholder="Image link">
                <label for="">Image link</label>
            </div>
            <input type="submit">
        </form>
    </div>
</div>
<?php
