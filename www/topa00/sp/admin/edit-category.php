<?php include 'elements/header.php';

if (isset($_GET['id'])){
  $category_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM categories WHERE id=$category_id";
  $categories_result = $db->prepare($query);
  $categories_result->execute();
  $category = $categories_result->fetch(PDO::FETCH_ASSOC);
} else {
  header('location: manage-posts.php');
}?>
  
  <section class="form-section">
    <div class="container form-section_container">
      <h2>Edit Category</h2>
      <form action="edit-category-logic.php" method="POST">
        <input type="hidden" value="<?=$category_id?>" name="id">
        <input type="text" value="<?=$category['title']?>" placeholder="Title">
        <input type="text" rows="4" value="<?= $category['description']?>"  placeholder="Description"></textarea>
        <button type="submit" class="button">Update</button>      
      </form>
    </div>
  </section>

  <?php include '../elements/footer.php' ?>