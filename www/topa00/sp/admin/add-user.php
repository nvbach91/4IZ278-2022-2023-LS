<?php include 'elements/header.php'; 

$first_name = $_SESSION['add-user_data']['first_name'] ?? null;
$last_name = $_SESSION['add-user_data']['last_name'] ?? null;
$email = $_SESSION['add-user_data']['email'] ?? null;
$create_password = $_SESSION['add-user_data']['create_password'] ?? null;
$confirm_password = $_SESSION['add-user_data']['confirm_password'] ?? null;
unset($_SESSION['add-user_data'])
?>
  
  <section class="form-section">
    <div class="container form-section_container">
      <h2>Add User</h2>
      <?php if(isset($_SESSION['add-user'])): ?>
      <div class="alert-message error">
        <p>
          <?= $_SESSION['add-user']; 
          unset($_SESSION['add-user']);?>
        </p>
      </div>
      <?php endif ?>
      <form action="add-user-logic.php" enctype="multipart/form-data" method="POST"> 
        <input type="text" name="first_name" value="<?=$first_name?>" placeholder="First Name">
        <input type="text" name="last_name" value="<?=$last_name?>" placeholder="Last Name">
        <input type="email" name="email" value="<?=$email?>" placeholder="Email">
        <input type="password" name="create_password" value="<?=$create_password?>" placeholder="Create password">
        <input type="password" name="confirm_password" value="<?=$confirm_password?>" placeholder="Confirm password">
        <select name="is_admin">
          <option value="0">User</option>
          <option value="1">Admin</option>
        </select>
        <div class="form-control">
          <label for="avatar">Add Avatar</label>
          <input type="file" name="avatar" id="avatar">
        </div>
        <button type="submit" name="submit" class="button">Add User</button>      
      </form>
    </div>
  </section>

<?php include '../elements/footer.php' ?>

