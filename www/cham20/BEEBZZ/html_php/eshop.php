<?php
include './ProductsDatabase.php';
// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "ESHOP BEEBZZ", $buffer);
echo $buffer;

if (isset($_GET['category'])) {
    $category = $_GET['category'];
} else {
    $category = 1;
}


$productDatabase = new ProductsDatabase;
$products = $productDatabase->fetchByCategory($category);

$errors = [];
if (!empty($_GET['price_from']) || !empty($_GET['price_to'])) {
    $price_from = htmlspecialchars(trim($_GET['price_from']));
    $price_to = htmlspecialchars(trim($_GET['price_to']));
    if ($price_from == '') {
        $price_from = 0;
    }
    if ($price_to == '') {
        $price_to = 100;
    }
    if (strpos($price_from, ',') == true) {
        $message = "Price must be entered whole or with . separator.";
        array_push($errors, $message);
    } elseif (strpos($price_to, ',') == true) {
        $message = "Price must be entered whole or with . separator.";
        array_push($errors, $message);
    } elseif ($price_from > $price_to) {
        $message = "Price from should be lower than price to.";
        array_push($errors, $message);
    } else {
        $category = $_GET['category'];
        $products = $productDatabase->fetchWithPrice($category, $price_from, $price_to);
    }
}



?>
<main>
    <div class="filters container">
        <div class="row">
            <form action="./eshop.php" method="GET">
                <input type="hidden" name="category" value="<?php echo $category ?>">
                <label for="">Price from:</label>
                <input type="text" name="price_from" min="0" placeholder="0">
                <label for="">To:</label>
                <input type="text" name="price_to" min="0" placeholder="30">
                <button class="btn btn-success">SUBMIT</button>
            </form>
        </div>
    </div>
    <?php if (!empty($errors)) : ?>
        <div class="container">
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="col-sm-4 card-container">
                    <a href="./one_product.php?product=<?php echo $product['product_id'] ?>" class="product">
                        <div class="card">
                            <div class="card-img-top card-img" style="background-image: url(<?php echo $product['picture']; ?>);">

                            </div>
                            <!--<div class="custom-img-container">
                                <img class="card-img-top img-fluid custom-img" src="<?php echo $product['picture']; ?>" alt="Card image cap">
                            </div>-->
                            <div class="card-body">
                                <h3 class="card-title text-center"><?php echo $product['name']; ?></h3>
                                <h4 class="price text-center"><?php echo $product['price']; ?>$</h4>
                                <h4 class="card-text text-center"><?php echo $product['q_in_stock']; ?> products in stock</h4>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php include './footer.php'; ?>