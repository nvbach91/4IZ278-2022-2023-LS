<a href="." class="list-group-item">All categories</a>
<?php foreach ($categories as $category) : ?>
    <a href="?category_id=<?php echo $category['category_id']; ?>" class="list-group-item">
        <?php echo $category['name']; ?>
    </a>
<?php endforeach; ?>