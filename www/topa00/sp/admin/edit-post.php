<?php include 'elements/header.php';
  
if (isset($_GET['id'])){
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts WHERE id=$id";
  $posts_results = $db->prepare($query);
  $posts_results->execute();
  $post = $posts_results->fetch(PDO::FETCH_ASSOC);

  $query = "SELECT * FROM categories";
  $categories_result = $db->prepare($query);
  $categories_result->execute();
  $categories = $categories_result->fetchAll(PDO::FETCH_ASSOC);
} else {
  header('location: manage-posts.php');
}
?>
  
  <section class="form-section">
    <div class="container form-section_container">
      <h2>Edit Post Info</h2>
      <form action="edit-post-logic.php" method="POST">
        <input type="hidden" value="<?=$post['id']?>" name="id">
        <input type="text" value="<?= $post['title']?>" name="title" placeholder="Title">
        <textarea name="body" rows="10" placeholder="Body"><?= $post['body']?></textarea>
        <?php if(isset($_SESSION['user_is_admin'])): ?>
        <div class="form-control inline">
          <input type="checkbox" name="is_featured" value="<?=$post['is_featured']?>" id="is_featured">
          <label for="is_featured">Featured</label>
        </div>
        <?php endif ?>
        <button type="submit" name="update" class="button">Update</button>      
      </form>
    </div>
  </section>

<?php include '../elements/footer.php' ?>