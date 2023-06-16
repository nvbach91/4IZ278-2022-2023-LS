<?php 
include 'elements/header.php';

if (isset($_GET['id'])) :
  $parent_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
else :
  $parent_id = null;
endif;
?>

<section class="form-section">
    <div class="container form-section_container">
      <h2>Add Comment</h2>
      <?php if(isset($_SESSION['add-comment'])): ?>
      <div class="alert-message error">
        <p>
          <?= $_SESSION['add-comment']; 
          unset($_SESSION['add-comment']);?>
        </p>
      </div>
      <?php endif ?>
      <form action="add-comment-logic.php" method="POST">
        <input type="hidden" value="<?=$parent_id?>" name="parent_id">
        <textarea rows="10" name="comment" placeholder="Comment"></textarea>
        <button type="submit" name="submit" class="button">Add comment</button>      
      </form>
    </div>
  </section>
