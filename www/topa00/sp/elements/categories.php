<section class="category-buttons">
    <div class="container category-buttons_container">
    <?php 
      $query = "SELECT * FROM categories ORDER BY title";
      $categories = mysqli_query($db, $query);
      while($category = mysqli_fetch_assoc($categories)): ?>
      <a href="category-posts.php?id=<?= $category['id']?>" class="category_button"><?= $category['title']?></a>
      <?php endwhile ?>
    </div>
  </section>