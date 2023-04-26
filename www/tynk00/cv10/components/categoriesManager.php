<h3 class="text-center">Kategorie</h3>
<?php if ($productsDatabase->getCount() > 0) : ?>




    <table class="table">
        <thead>
            <tr>
                <th>Obrázek</th>
                <th>Název</th>
                <th>Možnosti</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categoriesDatabase->fetchAll() as $category) : ?>
                <tr class="mx-1">
                    <td><img src="<?php echo $category["bg"] ?>" style="height: 30px" onerror="this.src='<?php img('placeholder.jpg'); ?>';" alt="no img"></td>
                    <td><?php echo $category["name"] ?></td>

                    <td>
                        <form class="w-auto d-inline" method="post" action="categoryEditor.php">
                            <input type="hidden" name="category_id" value="<?php echo $category["category_id"] ?>">
                            <input type="hidden" name="name" value="<?php echo $category["name"] ?>">
                            <input type="hidden" name="image" value="<?php echo $category["bg"] ?>">
                            <input type="hidden" name="edit" value="1">
                            <button class="btn btn-warning py-1" type="submit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </form>
                        <form class="w-auto d-inline" method="post" action="categoryEditor.php">
                            <input type="hidden" name="category_id" value="<?php echo $category["category_id"] ?>">
                            <input type="hidden" name="name" value="<?php echo $category["name"] ?>">
                            <input type="hidden" name="image" value="<?php echo $category["bg"] ?>">
                            <input type="hidden" name="copy" value="1">
                            <button class="btn btn-dark py-1" type="submit"><i class="fa fa-clone" aria-hidden="true"></i></button>
                        </form>

                        <form class="w-auto d-inline" method="get" action="deleteCategory.php">
                            <input type="hidden" name="category_id" value="<?php echo $category["category_id"] ?>">
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
        <h3>Nebyly vloženy žádné kategorie :/</h3>
    </div>

<?php endif; ?>
<hr class="mt-4 mb-3" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">
<form method="post" action="productEditor.php" class="w-auto mt-1">
    <button class="btn btn-dark" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Přidat novou kategorii</button>
</form>