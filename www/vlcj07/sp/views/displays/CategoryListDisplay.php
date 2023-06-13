<div class="flex flex-col px-5 py-2">
    <div>
        <h1 class="mt-4 text-2xl font-bold text-gray-700 dark:text-white">Kategorie:</h1>
    </div>
    <div>
        <?php foreach ($categories as $category) : ?>
            <h3 class="whitespace-nowrap mt-4 text-sm text-gray-700 dark:text-white"><?php echo $category["name"] ?> (id: <?php echo $category["category_id"] ?>)</h3>
        <?php endforeach; ?>
    </div>
</div>