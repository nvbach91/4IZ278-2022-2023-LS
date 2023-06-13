<?php include 'elements/header.php';
  
if (isset($_GET['id'])){
  $post_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts_categories WHERE post_id=$id";
  $result = mysqli_query($db, $query);
  $links = mysqli_fetch_assoc($result);

  $query_categories = "SELECT * FROM categories";
  $categories =mysqli_query($db, $query_categories);
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
          <?php while($category=mysqli_fetch_assoc($categories)) : ?>
          <option value="<?=$post['category_id']?>"><?=$category['title'] ?></option>
          <?php endwhile ?>
        </select>
        <button type="submit" name="add" class="button">Add</button>      
      </form>
    </div>
  </section>

<?php include '../elements/footer.php' ?>