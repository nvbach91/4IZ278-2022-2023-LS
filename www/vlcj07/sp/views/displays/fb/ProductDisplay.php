<?php foreach ($products as $product) : ?>
    <a href="product-fb.php?product_id=<?php echo $product['product_id'] ?>" class="group">
        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
            <img src="<?php echo $product["img"] ?>" alt="<?php echo $product["name"] ?>" class="h-full w-full aspect-[4/3] object-cover object-center group-hover:opacity-75">
        </div>
        <div>
            <h2 class="mt-4 text-xl font-bold text-gray-700 dark:text-white"><?php echo $product["name"] ?></h2>
            <p class="mt-1 text-lg font-medium text-gray-900 dark:text-white"><?php echo number_format($product['price'], 2), 'Kč'; ?></p>
            <h3 class="mt-4 text-sm text-gray-700 dark:text-white"><?php echo $product["description"] ?></h3>

        </div>
    </a>
<?php endforeach; ?>