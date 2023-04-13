<?php

namespace Views\Partials;

class ProductPartial
{
    public static function render($product)
    {
        ?>
        <div class="col mb-5">
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="<?php echo $product['image'] ?>" alt="..." />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">
                            <?php echo $product['name'] ?>
                        </h5>
                        <!-- Product price-->
                        <?php echo $product['price'] ?>
                    </div>
                </div>
                <!-- Product actions-->
                <!-- <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a>
                    </div>
                </div> -->
            </div>
        </div>
        <?php
    }
}
?>