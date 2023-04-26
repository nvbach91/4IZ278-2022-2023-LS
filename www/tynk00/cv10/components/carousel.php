<?php

$carouselItems = $productsDatabase->getSliderItems();

?>

<div class="card w-100 shadow-lg my-5 rounded text-bg-dark " style="width: 18rem;">
    <div class="card-header text-center">
        <h3 class="card-title mb-0">Naše nabídka</h3>
    </div>
    <div class="card-body py-0">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner bg-dark">
                <div class="carousel-item active">
                    <img src="<?php img('logo.png') ?>" class="d-block w-auto mx-auto" style="height: 450px" alt="...">
                    <div class="carousel-caption d-none d-md-block" style="background-color: #22222288;">
                        <h5>Vítejte na Foodcade</h5>
                    </div>

                </div>

                <?php foreach ($carouselItems as $product) : ?>
                    <a href="product.php?id=<?php echo $product['product_id'] ?>">
                        <div class="carousel-item">
                            <img src="<?php echo $product['image']; ?>" class="d-block w-auto mx-auto" style="height: 450px" alt="...">
                            <div class="carousel-caption d-none d-md-block" style="background-color: #22222288;">
                                <h5><?php echo $product['name']; ?></h5>
                                <p>Pouze za <?php echo $product['price']; ?>Kč</p>
                            </div>

                        </div>
                    </a>
                <?php endforeach; ?>


            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

</div>