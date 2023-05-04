<?php
session_start();
?>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($goods as $good) : ?>

                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="images/product<?php echo ($good['product_id'] + 1); ?>.png" alt="..." height="250px" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?php echo $good['name']; ?></h5>
                            <!-- Product price-->
                            <?php echo $good['price']; ?> Kč
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-outline-dark mt-auto" href='./addItem.php?id=<?php echo $good['product_id'] ?>'>
                                Add to cart
                            </a>
                            <?php if ($_SESSION['login'] > 1): ?>
                            <a class="btn btn-outline-dark mt-auto" href='./deleteItem.php?id=<?php echo $good['product_id'] ?>'>
                                Delete
                            </a>
                            <a class="btn btn-outline-dark mt-auto" href='./editItem.php?id=<?php echo $good['product_id'] ?>'>
                                Edit
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) { ?>
                    <a class="paginating" href="./index.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>