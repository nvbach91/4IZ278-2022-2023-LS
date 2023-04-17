<?php
require_once 'Product.php';
require_once './DBConnection.php';
// $product = new Product('test',100);
isset($_GET['category_id'])?$products = $dbcon->getProducts($_GET['category_id']):$products = $dbcon->getProducts();
echo
'
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
';
foreach( $products as $product ):
    echo $product -> getProductCard();
endforeach;
echo
'                
            </div>
        </div>
    </section>
'
?>