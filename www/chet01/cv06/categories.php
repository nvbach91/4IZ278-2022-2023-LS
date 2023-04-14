<?php require_once "./CategoriesDB.php";

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();
?>


<div class="list-group">
    <a class="list-group-item" href="./">
        All
    </a>
    <?php foreach ($categories as $cat) : ?>
        <a class="list-group-item" href="./?category_id=<?php echo $cat['category_id'] ?>">
            <?php echo $cat['name']; ?>
        </a>
    <?php endforeach ?>
</div>