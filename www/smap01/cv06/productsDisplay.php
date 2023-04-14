<section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php require_once('./ProductsDB.php');
                $productsDB = new ProductsDB();
                if (isset($_GET['category_id'])) {
                    $products = $productsDB->fetchByCategories($_GET['category_id']);
                    if(count($products)==0){
                        echo "<h1>There's nothing here yet!</h1>";
                    }
                    foreach ($products as $product) {
                        echo '<div class="col mb-5">
                                    <div class="card h-100">
                                        <!-- Product image-->
                                        <img class="card-img-top" src="' . $product['img'] . '" alt="product" />
                                        <!-- Product details-->
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <!-- Product name-->
                                                <h5 class="fw-bolder">' . $product['name'] . '</h5>
                                                <!-- Product price-->
                                                $' . $product['price'] . '
                                            </div>
                                        </div>
                                        <!-- Product actions-->
                                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                        </div>
                                    </div>
                                </div>';
                    }
                } else {
                    $products=$productsDB->fetchAll();
                    foreach ($products as $product) {
                        echo '<div class="col mb-5">
                                    <div class="card h-100">
                                        <!-- Product image-->
                                        <img class="card-img-top" src="' . $product['img'] . '" alt="product" />
                                        <!-- Product details-->
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <!-- Product name-->
                                                <h5 class="fw-bolder">' . $product['name'] . '</h5>
                                                <!-- Product price-->
                                                $' . $product['price'] . '
                                            </div>
                                        </div>
                                        <!-- Product actions-->
                                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                                        </div>
                                    </div>
                                </div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>