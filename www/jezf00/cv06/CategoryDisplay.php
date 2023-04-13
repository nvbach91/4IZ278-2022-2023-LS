<?php require_once './CategoriesDatabase.php' ?>
<?php

$categoriesDb = new CategoriesDatabase();
$categories = $categoriesDb->fetchAll();

?>

<div class="list-group">
    <a class="list-group-item" href="./">
        All
    </a>
    <?php foreach ($categories as $category) : ?>
        <a class="list-group-item" href="?category_id=<?php echo $category['category_id']; ?>" >
            <?php echo '(', $category['category_id'], ') ', $category['name']; ?>
        </a>
    <?php endforeach ?>
</div>
