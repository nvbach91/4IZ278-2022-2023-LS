<?php


require_once __DIR__ . "/views/partials/header_partial.php";
require_once __DIR__ . "/views/partials/footer_partial.php";
require_once __DIR__ . "/views/partials/slider_partial.php";
require_once __DIR__ . "/views/partials/product_list_partial.php";
require_once __DIR__ . "/views/partials/categories_partial.php";
use Views\Partials;

?>
<?php Partials\HeaderPartial::render(); ?>
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5 row row-cols-">
        <div class="col-3">
            <?php Partials\CategoriesPartial::render(); ?>
        </div>
        <div class="col-9">
            <div class="mb-5">
                <?php Partials\SliderPartial::render(); ?>
            </div>
            <?php
            $category_id = $_GET['category_id'] ?? null;
            Partials\ProductListPartial::render($category_id); ?>
        </div>
    </div>
</section>
<?php Partials\FooterPartial::render(); ?>