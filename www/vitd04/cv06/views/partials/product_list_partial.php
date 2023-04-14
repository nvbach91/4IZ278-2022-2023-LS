<?php

namespace Views\Partials;

require_once __DIR__ . '/../../repositories/product_repository.php';
require_once __DIR__ . '/product_partial.php';
use Repositories\ProductRepository;
use Views\Partials\ProductPartial;

class ProductListPartial
{
    public static function render($category_id = null)
    {

        $productRepository = new ProductRepository();

        if ($category_id == null)
            $products = $productRepository->fetchAll();
        else
            $products = $productRepository->fetchByCategoryId($category_id);

        $rows = array_chunk($products, 4);

        foreach ($rows as $row) {
            ?>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                foreach ($row as $product) {
                    ProductPartial::render($product);
                }
                ?>
            </div>
            <?php
        }
    }
}
?>