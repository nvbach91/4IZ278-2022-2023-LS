<div class="card w-100 shadow-lg my-5 rounded text-bg-dark" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Kategorie</h5>


    </div>
    <ul class="list-group list-group-flush">
        <a href="home.php" class="list-group-item list-group-item-action" aria-current="true">
            Všechny kategorie
        </a>
        <?php foreach ($categories as $category) : ?>
            <a href="home.php?category_id=<?php echo $category['category_id']; ?>" class="list-group-item list-group-item-action" aria-current="true">
                <?php echo $category['name']; ?>
            </a>

        <?php endforeach; ?>
    </ul>
</div>

<div class="card w-100 shadow-lg my-5 rounded text-bg-dark" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Ostatní odkazy</h5>
    </div>
    <ul class="list-group list-group-flush">
        <a href="https://esotemp.vse.cz/~tynk00/" class="list-group-item list-group-item-action" aria-current="true">
            Ostatní úkoly
        </a>
        <a href="https://github.com/nvbach91/4IZ278-2022-2023-LS/wiki/LAB09" class="list-group-item list-group-item-action" aria-current="true">
            Zadání
        </a>
        <a href="https://github.com/nvbach91/4IZ278-2022-2023-LS/wiki/LAB09" class="list-group-item list-group-item-action" aria-current="true">
            Splnění práce
        </a>
    </ul>

</div>

