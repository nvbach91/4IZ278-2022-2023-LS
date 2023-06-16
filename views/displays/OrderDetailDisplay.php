<div class="flex flex-col px-5 py-2">
    <div>
        <div class="flex flex-row gap-5 font-bold">
            <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Id objednávky: <?php echo $orders["order_id"] ?></h3>
            <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Datum objednávky: <?php echo $orders["date"] ?></h3>
            <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Status: <?php echo $orders["status"] ?></h3>
            <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Celková cena: <?php echo $orders["total_price"] ?></h3>
        </div>
        <hr class="mx-auto bg-black dark:bg-white w-full my-2">
    </div>
    <div class="flex flex-col gap-2">
        <?php foreach ($items as $item) : ?>
            <div class="flex flex-row gap-5">
                <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Množství: <?php echo $item["amount"] ?></h3>
                <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Cena produktu: <?php echo $item["price"] ?></h3>
                <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Id produktu: <?php echo $item["product_id"]  ?></h3>
                <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Produkt: <?php echo $item["product_name"] ?></h3>
            </div>
        <?php endforeach ?>
        <?php if ($current_user['role'] === 'admin') : ?>
        <a class="m-4 w-full whitespace-nowrap sm:w-auto text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="../views/edit-order.php?order_id=<?php echo $orders['order_id'] ?>">Upravit objednávku</a>
    <?php endif; ?>
    </div>
    
</div>