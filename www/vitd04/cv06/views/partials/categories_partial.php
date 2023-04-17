<?php

namespace Views\Partials;

require_once __DIR__ . '/../../repositories/category_repository.php';
use Repositories\CategoryRepository;

class CategoriesPartial
{
    public static function render()
    {
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->fetchAll();
        ?>
        <ul class="nav flex-column">
            <?php
            foreach ($categories as $category) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a>
                </li>
                <?php
            }
            ?>
            <!-- <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
            </li> -->
        </ul>
        <?php
    }
}
?>