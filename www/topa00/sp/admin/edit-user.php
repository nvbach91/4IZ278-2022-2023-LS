<?php include 'elements/header.php';

if (isset($_GET['id'])){
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM users WHERE id=$id";
  $result = mysqli_query($db, $query);
  $user = mysqli_fetch_assoc($result);
} else {
  header('location: manage-users.php');
}
?>
  
  <section class="form-section">
    <div class="container form-section_container">
      <h2>Edit User Info</h2>
      <form action="edit-user-logic.php" method="POST">
        <input type="hidden" value="<?=$user['id']?>" name="id">
        <input type="text" value="<?= $user['first_name']?>" name="first_name" placeholder="First Name">
        <input type="text" value="<?= $user['last_name']?>" name="last_name" placeholder="Last Name">
        <select name="is_admin">
          <option value="0">User</option>
          <option value="1">Admin</option>
        </select>
        <button type="submit" name="is_admin" class="button">Update</button>      
      </form>
    </div>
  </section>
<?php include 'elements/footer.php' ?>