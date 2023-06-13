<?php 
include 'elements/header.php';
include 'elements/dashboard.php';

$current_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE NOT id=$current_id";
$users_result = $db->prepare($query);
$users_result->execute();
$users = $users_result->fetchAll(PDO::FETCH_ASSOC);

?>
      <main>
        <h2>Manage Users</h2>
        <?php if (isset($_SESSION['add-user_success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['add-user_success'];
              unset($_SESSION['add-user_success']);
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['edit-user_success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['edit-user_success'];
              unset($_SESSION['edit-user_success'])
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['edit-user'])): ?>
          <div class="alert-message error">
            <p>
              <?= $_SESSION['edit-user'];
              unset($_SESSION['edit-user'])
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['delete-user_success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['delete-user_success'];
              unset($_SESSION['delete-user_success'])
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['delete-user'])): ?>
          <div class="alert-message error">
            <p>
              <?= $_SESSION['delete-user'];
              unset($_SESSION['delete-user'])
              ?>
            </p>
          </div>
        <?php endif ?>

        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Edit</th>
              <th>Delete</th>
              <th>Admin</th>
            </tr>            
          </thead>
          <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
              <td><?= "{$user['first_name']} {$user['last_name']}" ?></td>
              <td><?= "{$user['email']}"?></td>
              <td><a href="edit-user.php?id=<?= $user['id'] ?>" class="button">Edit</a></td>
              <td><a href="delete-user.php?id=<?= $user['id'] ?>" class="button delete">Delete</a></td>
              <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </main>
    </div>
  </section>

<?php include '../elements/footer.php' ?>