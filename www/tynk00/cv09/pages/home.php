<?php

require_once('../database/loadData.php');


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$maxProducts = 4;


if (isset($_GET['category_id'])) {
    $products = $productsDatabase->fetchCategory($_GET['category_id'], $page, $maxProducts);
    $noProducts = $productsDatabase->getCountByCategory($_GET['category_id']);
} else {
    $products = $productsDatabase->fetchAll($page, $maxProducts);
    $noProducts = $productsDatabase->getCount();
}

$total_pages = ceil($noProducts / $maxProducts);

include('../components/header.php');




?>

<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
        <h3 class="card-title">Vítejte na super shop</h3>
    </div>
    <div class="card-body text-dark">
        Vítejte v našem virtuálním obchodě s jídlem a pitím! Jsme rádi, že jste nás našli a těšíme se, že vám můžeme nabídnout širokou škálu produktů, 
        které vám pomohou udělat si chutnou a zdravou snídani, oběd nebo večeři. U nás najdete vše od čerstvých sezónních plodů a zeleniny až po nejlepší kávu, 
        čaje a další nápoje. Naši dodavatelé jsou pečlivě vybíráni tak, aby vám mohli nabídnout nejvyšší kvalitu, čerstvost a chuť. Pokud máte nějaké dotazy, 
        neváhejte nás kontaktovat. Jsme tu pro vás a rádi vám pomůžeme s výběrem produktů, které nejenom budou chutnat, ale také 
        vám dodají dostatek energie a vitamínů pro celý den.
    </div>

</div>




<div class="card w-100 shadow-lg my-5 rounded text-bg-dark" style="width: 18rem;">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner bg-dark">
            <div class="carousel-item active">
                <img src="<?php img('logo.png') ?>" class="d-block w-auto mx-auto" style="height: 450px" alt="...">
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
</div>


<?php

include('../components/offers.php');
include('../components/footer.php');

?>