<?php include 'elements/header.php';
  
if (isset($_GET['id'])){
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts WHERE id=$id";
  $result = mysqli_query($db, $query);
  $post = mysqli_fetch_assoc($result);

  $query_categories = "SELECT * FROM categories";
  $categories =mysqli_query($db, $query_categories);
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
        <input type="text" value="<?= $post['body']?>" name="body" placeholder="Body">
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