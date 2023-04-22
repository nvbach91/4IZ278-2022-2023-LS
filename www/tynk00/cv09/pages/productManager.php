<?php

require_once('../database/loadData.php');


include('../components/header.php');



?>




<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
    </div>
    <div class="card-body text-dark">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <h3 class="text-center">Produkty</h3>
                <?php if ($productsDatabase->getCount() > 0) : ?>




                    <table class="table">
                        <thead>
                            <tr>
                                <th>Obrázek</th>
                                <th>Název</th>
                                <th>Kategorie</th>
                                <th>Cena</th>
                                <th>Možnosti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productsDatabase->getAll() as $product) : ?>
                                <tr class="mx-1">
                                    <td><img src="<?php echo $product["image"] ?>" style="height: 30px" alt="Product 1"></td>
                                    <td><?php echo $product["name"] ?></td>

                                    <td>
                                        <?php echo $categoriesDatabase->getCategoryName($product['category']) ?>
                                    </td>
                                    <td><?php echo $product['price'] ?> Kč</td>
                                    <td class="row">
                                        <form class="col-lg-2 col-md-3 col-sm-4" method="post" action="productEditor.php">
                                            <input type="hidden" name="product_id" value="<?php echo $product["product_id"] ?>">
                                            <input type="hidden" name="name" value="<?php echo $product["name"] ?>">
                                            <input type="hidden" name="category" value="<?php echo $product["category"] ?>">
                                            <input type="hidden" name="price" value="<?php echo $product["price"] ?>">
                                            <input type="hidden" name="image" value="<?php echo $product["image"] ?>">
                                            <input type="hidden" name="edit" value="1">
                                            <button class="btn btn-warning py-1" type="submit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                        </form>

                                        <form class="col-lg-2 col-md-3 col-sm-4" method="get" action="deleteProduct.php">
                                            <input type="hidden" name="product_id" value="<?php echo $product["product_id"] ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <button class="btn btn-danger py-1" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>



                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="row">

                    </div>





                <?php else : ?>
                    <div class="text-center my-5">
                        <img class="w-25 mb-3" src="<?php img('error.png') ?>" alt="" srcset="">
                        <h3>Nebyly vloženy žádné produkty :/</h3>
                    </div>

                <?php endif; ?>
                <form method="post" action="productEditor.php" class="w-auto">
                    <button class="btn btn-primary" type="submit">Přidat nový produkt</button>
                </form>

            </div>

        </div>
    </div>
</div>


<?php

include('../components/footer.php');

?>