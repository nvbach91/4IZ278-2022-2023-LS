<div class="flex flex-col px-5 py-2">
    <div>
    </div>
    <div>
        <?php foreach ($orders as $order) : ?>
            <a href="order-details.php?order_id=<?php echo $order['order_id'] ?>">
                <div class="flex flex-row gap-5">
                    <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Id objednávky: <?php echo $order["order_id"] ?></h3>
                    <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Datum objednávky: <?php echo $order["date"] ?></h3>
                    <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Status: <?php echo $order["status"] ?></h3>
                    <h3 class="whitespace-nowrap text-sm text-gray-700 dark:text-white">Celková cena: <?php echo $order["total_price"] ?></h3>
                </div>
            </a>
            <hr class="mx-auto bg-black dark:bg-white w-full my-2">
        <?php endforeach; ?>
    </div>
</div>