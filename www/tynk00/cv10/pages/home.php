<?php
session_start();
require_once('../database/loadData.php');


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$maxProducts = 8;

if(isset($_GET['order'])){
    $order = $_GET['order'];
}
else {
    $order = 'name';
}


if (isset($_GET['category_id'])) {
    $products = $productsDatabase->fetchCategory($_GET['category_id'], $page, $maxProducts, $order);
    $noProducts = $productsDatabase->getCountByCategory($_GET['category_id']);
} else {
    $products = $productsDatabase->fetchAll($page, $maxProducts, $order);
    $noProducts = $productsDatabase->getCount();
}

$total_pages = ceil($noProducts / $maxProducts);

include('../components/header.php');




?>

<?php if (!isset($_GET['category_id']) && !isset($_GET['page'])) : ?>

    <div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
        <div class="card-header py-3 text-bg-dark text-center">
            <h3 class="card-title mb-0">Vítejte na Foodcade</h3>
        </div>
        <div class="card-body text-dark">
            Vítejte v našem virtuálním obchodě s jídlem a pitím! Jsme rádi, že jste nás našli a těšíme se, že vám můžeme nabídnout širokou škálu produktů,
            které vám pomohou udělat si chutnou a zdravou snídani, oběd nebo večeři. U nás najdete vše od čerstvých sezónních plodů a zeleniny až po nejlepší kávu,
            čaje a další nápoje. Naši dodavatelé jsou pečlivě vybíráni tak, aby vám mohli nabídnout nejvyšší kvalitu, čerstvost a chuť. Pokud máte nějaké dotazy,
            neváhejte nás kontaktovat. Jsme tu pro vás a rádi vám pomůžeme s výběrem produktů, které nejenom budou chutnat, ale také
            vám dodají dostatek energie a vitamínů pro celý den.
        </div>

    </div>

    <?php
    include('../components/carousel.php');
    ?>

<?php endif; ?>

<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark text-center">
        <h3 class="card-title mb-0">Kategorie</h3>
    </div>
    <div class="card-body text-dark">
        <div class="row m-4">


            <?php foreach ($categories as $category) : ?>


                <div class="col-lg-3 mb-4">
                    <a href="home.php?category_id=<?php echo $category['category_id']; ?>">
                        <div class="card bg-dark text-white p-0 shadow" style="height: 150px;">
                            <img src="<?php echo $category['bg'] ?>" class="card-img" style="object-fit: cover; height: 100%;" alt="...">
                            <div class="card-img-overlay d-flex flex-column justify-content-end" style="background-color: #11111188">
                               <h6 class="card-title"><b><?php echo $category['name'] ?></b></h6>
                            </div>
                        </div>
                    </a>


                </div>
            <?php endforeach; ?>
        </div>


    </div>

</div>


<?php

include('../components/offers.php');
include('../components/footer.php');

?>