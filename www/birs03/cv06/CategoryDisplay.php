<?php require_once './CategoriesDatabase.php';?>
<?php

$categoriesDatabase = new CategoriesDatabase();
$categories = $categoriesDatabase->fetchAll();

?>

<div>
    <a href="?categorie_id=">All categories</a>
    <?php foreach($categories as $category): ?>
        <a href="?category_id=<?php echo $category['category_id'];?>">
            <?php echo $category['name']; ?>
        </a>
    <?php endforeach;?>
</div>