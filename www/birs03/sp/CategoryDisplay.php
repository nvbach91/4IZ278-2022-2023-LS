<?php require_once 'CategoriesDatabase.php';?>
<?php

$categoriesDatabase = new CategoriesDatabase();
$categories = $categoriesDatabase->fetchAll();

?>

<div>
    <a style='text-decoration:none;padding:10px;<?php if(empty($_GET['category_id'])){echo 'font-weight:bold;color:black';}?>' href="?category_id=">All categories</a>
    <?php foreach($categories as $category): ?>
        <a style='text-decoration:none;padding:10px;<?php if($_GET['category_id']==$category['category_id']){echo 'font-weight:bold;color:black';}?>' href="?category_id=<?php echo $category['category_id'];?>">
            <?php echo $category['name']; ?>
        </a>
    <?php endforeach;?>
</div>