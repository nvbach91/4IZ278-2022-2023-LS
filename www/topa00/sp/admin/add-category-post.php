<?php include 'elements/header.php';
  
if (isset($_GET['id'])){
  $post_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts_categories WHERE post_id=$id";
  $link_results = $db->prepare($query);
  $link_results->execute();
  $links = $link_result->fetchAll(PDO::FETCH_ASSOC);

  $query = "SELECT * FROM categories";
  $category_result = $db->prepare($query);
  $category_result->execute();
  $categories = $category_result->fetchAll(PDO::FETCH_ASSOC);
} else {
  header('location: manage-posts.php');
}
?>
  
  <section class="form-section">
    <div class="container form-section_container">
      <h2>Add Category</h2>
      <form action="add-category-post-logic.php" method="POST">
        <input type="hidden" value="<?=$post['id']?>" name="id">
        <select name="category">
          <?php foreach($categories as $category) : ?>
          <option value="<?=$post['category_id']?>"><?=$category['title'] ?></option>
          <?php endforeach ?>
        </select>
        <button type="submit" name="add" class="button">Add</button>      
      </form>
    </div>
  </section>

<?php include '../elements/footer.php' ?>