<?php
session_start();
require_once('../database/loadData.php');


include('../components/header.php');

?>




<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
    <h3 class="card-title mb-0 text-center">Košík</h3>
    </div>
    <div class="card-body text-dark">
        <div class="row justify-content-center">
            <div class="col-md-11">
                
                <?php if (!empty($_SESSION['cart'])) : ?>




                    <table class="table">
                        <thead>
                            <tr>
                                <th>Název</th>
                                <th>Množství</th>
                                <th>Možnosti</th>
                                <th>Celková cena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_price = 0; ?>
                            <?php foreach ($_SESSION['cart'] as $product_id => $quantity) : ?>
                                <?php $product = $productsDatabase->getProductById($product_id); ?>
                                <tr class="mx-1">
                                    <td><?php echo $product["name"] ?></td>
                                    <td><?php echo $quantity ?></td>

                                    <td>
                                        <form method="post" action="../cartModel.php">
                                            <input type="hidden" name="action" value="remove">
                                            <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                                            <input type="hidden" name="action" value="remove">
                                            <button class="btn btn-danger py-1" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                    <td><?php echo $product['price'] * $quantity ?> Kč</td>
                                    <?php $total_price += $product['price'] * $quantity; ?>
                                </tr>

                            <?php endforeach; ?>
                            <tr class="bg-dark text-light mx-1" style="font-weight: bold">
                                <td>Celkem</td>
                                <td></td>

                                <td>
                                </td>
                                <td><?php echo $total_price; ?> Kč</td>
                            </tr>


                        </tbody>
                    </table>

                    <div class="row">
                        
                    </div>

                    <form method="post" action="../cartModel.php" class="w-auto">
                        <input type="hidden" name="action" value="clear">
                        <button class="btn btn-dark" type="submit">Vymazat obsah košíku</button>
                        <button class="btn btn-primary disabled">Pokračovat v objednávce</button>
                    </form>

                    

                <?php else : ?>
                    <div class="text-center my-5">
                        <img class="w-25 mb-3" src="<?php img('error.png') ?>" alt="" srcset="">
                        <h3>Košík je prázdný :/</h3>
                    </div>

                <?php endif; ?>


            </div>

        </div>
    </div>
</div>


<?php

include('../components/footer.php');

?>