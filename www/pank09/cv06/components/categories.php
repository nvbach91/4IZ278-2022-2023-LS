<ul class="nav nav-pills nav-fill my-5">
    <li class="nav-item">
        <a class="nav-link <?php if (!$categoryIsSet) echo "active"; ?>" aria-current="page" href="./">All categories</a>
    </li>

    <?php foreach($categories as $category): ?>
        <li class="nav-item">
            <a class="nav-link <?php if ($categoryIsSet && $_GET['category_id'] == $category['category_id']) echo "active"; ?>" href="./?category_id=<?php echo $category['category_id'] ?>">
                <?php echo $category['name']; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>