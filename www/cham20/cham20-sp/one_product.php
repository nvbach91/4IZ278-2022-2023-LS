<?php
include './ProductsDatabase.php';
// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "PRODUCT", $buffer);
echo $buffer;

if (isset($_GET['product'])) {
    $product_id = $_GET['product'];
} else {
    $product_id = 1;
}
$productDatabase = new ProductsDatabase;
$products = $productDatabase->fetchByProductId($product_id);

$quantity = 1;
?>
<main>
    <?php foreach ($products as $product) : ?>
        <div class="container one-product-container">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo $product['picture']; ?>" alt="">
                </div>
                <div class="col-md-6 product-info">
                    <h3 class=""><?php echo $product['name']; ?></h3>
                    <h4 class="price"><?php echo $product['price']; ?>$</h4>
                    <p class=""><?php echo $product['description']; ?> products in stock</p>
                    <a href="./add_to_cart.php?product_id=<?php echo $product_id?>&quantity=<?php echo $quantity ?>"><button class="btn btn-success">ADD TO CART</button></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</main>
<?php include './footer.php'; ?>