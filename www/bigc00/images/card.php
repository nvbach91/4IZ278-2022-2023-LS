<div class="card h-100">
    <!-- Product image-->
    <img class="card-img-top" src="images/product<?php echo ($good['product_id'] + 1); ?>.png" alt="..." height="250px"/>
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
        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
    </div>
</div>