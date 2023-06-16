<section class="category-buttons">
    <div class="container category-buttons_container">
    <?php 
      $query = "SELECT * FROM categories ORDER BY title";
      $categories_result = $db->prepare($query);
      $categories_result->execute();
      $categories = $categories_result->fetchAll(PDO::FETCH_ASSOC);
      foreach ($categories as $category): ?>
      <a href="category-posts.php?id=<?= $category['id']?>" class="category_button"><?= $category['title']?></a>
      <?php endforeach ?>
    </div>
  </section>