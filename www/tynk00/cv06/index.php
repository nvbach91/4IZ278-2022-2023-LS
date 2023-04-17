<?php

include('header.php');

?>



<div id="carouselExampleControls" class="carousel slide my-5" data-bs-ride="carousel">
    <div class="carousel-inner bg-dark">
    <div class="carousel-item active">
                <img src="logo.png" class="d-block w-auto mx-auto" style="height: 450px" alt="...">
                <div class="carousel-caption d-none d-md-block" style="background-color: #22222288;">
                    <h5>Vítejte v super eshopu</h5>
                </div>

            </div>
        <?php foreach ($products as $product) : ?>
            <div class="carousel-item">
                <img src="<?php echo $product['image']; ?>" class="d-block w-auto mx-auto" style="height: 450px" alt="...">
                <div class="carousel-caption d-none d-md-block" style="background-color: #22222288;">
                    <h5><?php echo $product['name']; ?></h5>
                    <p>Pouze za <?php echo $product['price']; ?>Kč</p>
                </div>

            </div>
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

<?php

include('offers.php');
include('footer.php');

?>