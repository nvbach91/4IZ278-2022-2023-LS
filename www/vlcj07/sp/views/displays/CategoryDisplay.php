<div class="flex flex-row gap-5">
    <a href="./products.php" class="list-group-item">Všechny produkty</a>
    <?php foreach ($categories as $category) : ?>
        <a href="?category_id=<?php echo $category['category_id']; ?>" class="list-group-item">
            <?php echo $category['name']; ?>
        </a>
    <?php endforeach; ?>
</div>