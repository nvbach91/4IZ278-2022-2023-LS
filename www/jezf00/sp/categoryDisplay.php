<?php require_once './categoriesDatabase.php' ?>
<?php

$categoriesDb = new CategoriesDatabase();
$categories = $categoriesDb->fetchAll();

?>

<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      
      <div class="card">

          <div class="list-group">
          <?php if (isset($_SESSION['user']) && $_SESSION['user']['privilege'] >= 2) : ?>
        <a class="btn btn-outline-secondary" href="admin/create-category.php">Add new category</a>
        <?php endif; ?>
              <a class="list-group-item" href="./">
                  All
              </a>
              <?php foreach ($categories as $category) : ?>
                  <a class="list-group-item" href="?category_id=<?php echo $category['category_id']; ?>" >
                      <?php echo $category['name']; ?>
                  </a>
                  <?php if (isset($_SESSION['user']) && $_SESSION['user']['privilege'] >= 2) : ?>
                    <a class="btn btn-outline-secondary" href="admin/rename-categories.php?category_id=<?php echo $category['category_id'] ?>">Rename</a>
                            <a class="btn btn-outline-secondary" href="admin/delete-categories.php?category_id=<?php echo $category['category_id'] ?>">Delete</a>
                    <?php endif; ?>
              <?php endforeach ?>
          
        </div>
      </div>
    </div>
  </div>
</div>
