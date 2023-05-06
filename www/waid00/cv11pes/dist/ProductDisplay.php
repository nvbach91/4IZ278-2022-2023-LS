<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <?php
        if ($page > 1) {
            echo "<a href='?page=" . ($page - 1) . "' class='pagination-link'>Previous</a> ";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo "<a href='?page=" . $i . "' class='pagination-link active'>" . $i . "</a> ";
            } else {
                echo "<a href='?page=" . $i . "' class='pagination-link'>" . $i . "</a> ";
            }
        }

        if ($page < $total_pages) {
            echo "<a href='?page=" . ($page + 1) . "' class='pagination-link'>Next</a>";
        }
        ?>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            foreach ($viewed_products as $e_product) {
            ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="<?php echo $e_product['image']; ?>" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo $e_product['name']; ?></h5>
                                <!-- Product price-->
                                $<?php echo $e_product['price']; ?>
                            </div>
                        </div>
                        <!-- Product actions-->
<?php  if ($_SESSION['privilege'] >= 1) { ?>
    <a class="btn btn-outline-dark mt-auto" href="edit.php?id=<?php echo $e_product['product_id']; ?>&name=<?php echo $e_product['name']; ?>&price=<?php echo $e_product['price']; ?>&special=<?php echo $e_product['special']; ?>&image=<?php echo $e_product['image']; ?>">
                            Edit product
                        </a>
                        <a class="btn btn-outline-dark mt-auto" href="delete.php?id=<?php echo $e_product['product_id']; ?>">
                            Delete product
                        </a>
    <?php ; } ?>

                        <a class="btn btn-outline-dark mt-auto" href="?add=<?php echo $e_product['product_id']; ?>&user_id=<?php echo $_SESSION['user_id']; ?>&date=<?php echo date('Y-m-d H:i:s'); ?>&discount=0">
                            Add to cart
                        </a>

                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
        if ($page > 1) {
            echo "<a href='?page=" . ($page - 1) . "' class='pagination-link'>Previous</a> ";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo "<a href='?page=" . $i . "' class='pagination-link active'>" . $i . "</a> ";
            } else {
                echo "<a href='?page=" . $i . "' class='pagination-link'>" . $i . "</a> ";
            }
        }

        if ($page < $total_pages) {
            echo "<a href='?page=" . ($page + 1) . "' class='pagination-link'>Next</a>";
        }



        ?>
    </div>

</section>