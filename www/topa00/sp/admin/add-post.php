<?php 
include 'elements/header.php';

$query = "SELECT * FROM categories";
$categories =mysqli_query($db, $query);
?>
  
  <section class="form-section">
    <div class="container form-section_container">
      <h2>Add Post</h2>
      <?php if(isset($_SESSION['add-post'])): ?>
      <div class="alert-message error">
        <p>
          <?= $_SESSION['add-post']; 
          unset($_SESSION['add-post']);?>
        </p>
      </div>
      <?php endif ?>
      <form action="add-post-logic.php" enctype="multipart/form-data" method="POST">
        <input type="text" name="title" placeholder="Title">
        <select name="category">
          <?php while($category=mysqli_fetch_assoc($categories)) : ?>
          <option value="<?=$category['id'] ?>"><?=$category['title'] ?></option>
          <?php endwhile ?>
        </select>        
        <textarea rows="10" name="body" placeholder="Body"></textarea>
        <?php if(isset($_SESSION['user_is_admin'])): ?>
        <div class="form-control inline">
          <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
          <label for="is_featured">Featured</label>
        </div>
        <?php endif ?>
        <div class="form-control">
          <label for="thumbnail">Add Thumbnail</label>
          <input type="file" name="thumbnail" if="thumbnail">
        </div>
        <button type="submit" name="submit" class="button">Add post</button>      
      </form>
    </div>
  </section>

<?php include '../elements/footer.php' ?>