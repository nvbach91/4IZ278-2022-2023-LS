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
$start = 0;
$rows_per_page = 3;
$records = $productDatabase->fetchByCategory($category);
$number_of_rows = count($records);
$pages = ceil($number_of_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}


$products = $productDatabase->fetchByCategoryPagination($category, $start, $rows_per_page);

$errors = [];
if (!empty($_GET['price_from']) || !empty($_GET['price_to'])) {
    $price_from = htmlspecialchars(trim($_GET['price_from']));
    $price_to = htmlspecialchars(trim($_GET['price_to']));
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
                <input type="text" name="price_from" min="0" value="0">
                <label for="">To:</label>
                <input type="text" name="price_to" min="0" value="50">
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
                            <div class="text-center">
                                <a href="./add_to_cart.php?product_id=<?php echo $product['product_id'] ?>&quantity=1&from=eshop&category=<?php echo $category; ?>"><button class="btn btn-success">ADD TO CART</button></a>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="page-info text-center">
        <?php
        if (!isset($_GET['page-nr'])) {
            $page = 1;
        } else {
            $page = $_GET['page-nr'];
        }
        ?>
        Page <?php echo $page; ?> of <?php echo $pages; ?>
    </div>
    <div class="pagination container text-center">
        <a href="?category=<?php echo $category ?>&page-nr=1"><button type="button" class="btn btn-dark">First</button></a>
        <?php
        if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) :
        ?>
            <a href="?category=<?php echo $category ?>&page-nr=<?php echo $_GET['page-nr'] - 1 ?>"><button type="button" class="btn btn-dark">Previous</button></a>
        <?php else : ?>
            <a href=""><button type="button" class="btn btn-dark">Previous</button></a>
        <?php endif; ?>

        <div class="page-numbers">
            <?php
            for ($counter = 1; $counter <= $pages; $counter++) :
            ?>
                <a href="?category=<?php echo $category ?>&page-nr=<?php echo $counter ?>"><button type="button" class="btn btn-dark"><?php echo $counter ?></button></a>
            <?php endfor; ?>
        </div>

        <?php
        if (!isset($_GET['page-nr'])) :
        ?>
            <?php if ($number_of_rows <= 3) : ?>
                <a href=""><button type="button" class="btn btn-dark">Next</button></a>
            <?php else : ?>
                <a href="?category=<?php echo $category ?>&page-nr=2"><button type="button" class="btn btn-dark">Next</button></a>
            <?php endif; ?>
        <?php else : ?>
            <?php if ($_GET['page-nr'] >= $pages) : ?>
                <a href=""><button type="button" class="btn btn-dark">Next</button></a>
            <?php else : ?>
                <a href="?category=<?php echo $category ?>&page-nr=<?php echo $_GET['page-nr'] + 1 ?>"><button type="button" class="btn btn-dark">Next</button></a>
            <?php endif; ?>
        <?php endif; ?>
        <a href="?category=<?php echo $category ?>&page-nr=<?php echo $pages; ?>"><button type="button" class="btn btn-dark">Last</button></a>
    </div>
</main>
<script>
    let links = document.querySelectorAll('.page-numbers > a > button');
    let bodyId = parseInt(document.body.id) - 1;
    links[bodyId].classList.add("active");
</script>
<?php include './footer.php'; ?>