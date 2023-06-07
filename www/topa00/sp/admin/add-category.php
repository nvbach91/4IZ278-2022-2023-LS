<?php include 'elements/header.php';

$title = $_SESSION['add-category_data']['title'] ?? null;
$description = $_SESSION['add-category_data']['description'] ?? null;
unset($_SESSION['add-category_data'])
?>
  
  <section class="form-section">
    <div class="container form-section_container">
      <h2>Add Category</h2>
      <?php if(isset($_SESSION['add-category'])): ?>
      <div class="alert-message error">
        <p>
          <?= $_SESSION['add-category']; 
          unset($_SESSION['add-category']);?>
        </p>
      </div>
      <?php endif ?>
      <form action="add-category-logic.php" method="POST">
        <input type="text" name="title" value="<?=$title?>" placeholder="Title">
        <textarea rows="4" name="description" placeholder="Description"><?=$description?></textarea>
        <button type="submit" name="submit" class="button">Add category</button>      
      </form>
    </div>
  </section>
<?php include '../elements/footer.php' ?>