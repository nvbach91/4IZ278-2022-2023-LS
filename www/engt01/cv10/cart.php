<?php
session_start();
if (!isset($_SESSION["userType"])) header("Location: login.php");

require "db/ProductsDatabase.php";

$cart = $_SESSION["cart"] ?? [];
$products = [];
$productsDb = new ProductsDatabase();

foreach ($cart as $gid) {
    $products[] = $productsDb->fetch($gid);
}

include "components/header.php";
?>
<main class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (!empty($cart)): foreach ($products as $item): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <?php if (!empty($item["img"])): ?>
                            <img class="card-img-top" src="<?php echo $item["img"] ?>"
                                 alt="Product image for <?php echo $item["name"] ?>"/>
                        <?php endif ?>
                        <!-- Product details-->
                        <div class="card-body p-4 text-center">
                            <!-- Product name-->
                            <h5 class="card-title fw-bolder"><?php echo $item["name"] ?></h5>
                            <!-- Product price-->
                            <span class="card-text">$<?php echo $item["price"] ?></span>
                            <p class="card-text"><?php echo $item["description"] ?></p>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                                        href="remove-item.php?good_id=<?php echo $item["good_id"] ?>">Odstranit</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; else: ?>
                <div>Košík je prázdný</div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php include "components/footer.php" ?>
