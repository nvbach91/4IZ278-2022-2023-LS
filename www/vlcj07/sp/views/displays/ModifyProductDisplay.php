<?php foreach ($products as $product) : ?>
    <a href="#products" class="group">
        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
            <img src="<?php echo $product["img"] ?>" alt="<?php echo $product["name"] ?>" class="h-full w-full aspect-[4/3] object-cover object-center group-hover:opacity-75">
        </div>
        <div>
            <h2 class="mt-4 text-xl font-bold text-gray-700 dark:text-white"><?php echo $product["name"] ?></h2>
            <p class="mt-1 text-lg font-medium text-gray-900 dark:text-white"><?php echo number_format($product['price'], 2), 'Kč'; ?></p>
            <h3 class="mt-4 text-sm text-gray-700 dark:text-white"><?php echo $product["description"] ?></h3>
            <?php if (isset($_SESSION['user_id'])) : ?>

                <div class="flex flex-row">
                    <div class="my-4 mx-1 text-center">
                        <a class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="../views/edit-item.php?product_id=<?php echo $product['product_id'] ?>">Upravit</a>
                    </div>
                    <div class="my-4 mx-1 text-center">
                        <a id="delete-button" onclick="confirmDelete(event)" class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="../controllers/delete-itemController.php?product_id=<?php echo $product['product_id'] ?>">Smazat</a>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </a>
<?php endforeach; ?>