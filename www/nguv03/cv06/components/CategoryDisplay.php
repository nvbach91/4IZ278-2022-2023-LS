<?php
$categories = [
    ['number' => 0, 'name' => 'Alphonso'],
    ['number' => 1, 'name' => 'Chaunsa'],
    ['number' => 2, 'name' => 'Langra'],
    ['number' => 3, 'name' => 'Benishan'],
];
// fetch from database
?>
<div class="list-group">
    <?php foreach($categories as $category): ?>
    <a href="#" class="list-group-item"><?php echo '(', $category['number'], ') ', $category['name']; ?></a>
    <?php endforeach; ?>
</div>
