<?php require_once __DIR__ . '/../db/CategoriesDB.php'; ?>
<?php

$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();

// $categories = [
//     ['category_id' => 0, 'name' => 'Alphonso'],
//     ['category_id' => 1, 'name' => 'Chaunsa'],
//     ['category_id' => 2, 'name' => 'Langra'],
//     ['category_id' => 3, 'name' => 'Benishan'],
// ];
?>

<div class="list-group">
    <a href="." class="list-group-item">All categories</a>
    <?php foreach($categories as $category): ?>
    <a href="?category_id=<?php echo $category['category_id']; ?>" class="list-group-item">
        <?php echo '[', $category['category_id'], '] ', $category['name']; ?>
    </a>
    <?php endforeach; ?>
</div>
