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
                    <td><img src="<?php echo $product["image"] ?>" style="height: 30px" onerror="this.src='<?php img('placeholder.jpg'); ?>';" alt="no img"></td>
                    <td><?php echo $product["name"] ?></td>

                    <td>
                        <?php echo $categoriesDatabase->getCategoryName($product['category']) ?>
                    </td>
                    <td><?php echo $product['price'] ?> Kč</td>
                    <td>
                        <form class="w-auto d-inline" method="post" action="productEditor.php">
                            <input type="hidden" name="product_id" value="<?php echo $product["product_id"] ?>">
                            <input type="hidden" name="name" value="<?php echo $product["name"] ?>">
                            <input type="hidden" name="category" value="<?php echo $product["category"] ?>">
                            <input type="hidden" name="price" value="<?php echo $product["price"] ?>">
                            <input type="hidden" name="image" value="<?php echo $product["image"] ?>">
                            <input type="hidden" name="description" value="<?php echo $product["description"] ?>">
                            <input type="hidden" name="edit" value="1">
                            <button class="btn btn-warning py-1" type="submit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </form>
                        <form class="w-auto d-inline" method="post" action="productEditor.php">
                            <input type="hidden" name="product_id" value="<?php echo $product["product_id"] ?>">
                            <input type="hidden" name="name" value="<?php echo $product["name"] ?>">
                            <input type="hidden" name="category" value="<?php echo $product["category"] ?>">
                            <input type="hidden" name="price" value="<?php echo $product["price"] ?>">
                            <input type="hidden" name="image" value="<?php echo $product["image"] ?>">
                            <input type="hidden" name="description" value="<?php echo $product["description"] ?>">
                            <input type="hidden" name="copy" value="1">
                            <button class="btn btn-dark py-1" type="submit"><i class="fa fa-clone" aria-hidden="true"></i></button>
                        </form>

                        <form class="w-auto d-inline" method="get" action="deleteProduct.php">
                            <input type="hidden" name="product_id" value="<?php echo $product["product_id"] ?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="product_id" value="<?php echo $product["product_id"] ?>">
                            <button class="btn btn-danger py-1" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>

                        <form class="w-auto d-inline" method="get" action="markProduct.php">
                            <a href="product.php?id=<?php echo $product['product_id'] ?>" class="btn btn-primary py-1" type="submit"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
<hr class="mt-4 mb-3" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">
<form method="post" action="productEditor.php" class="w-auto mt-1">
    <button class="btn btn-dark" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Přidat nový produkt</button>
</form>