<?php 
include 'elements/header.php';
include 'elements/dashboard.php';

$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($db, $query);
?>

      <main>
        <h2>Manage Categories</h2>
        <?php if (isset($_SESSION['add-category_success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['add-category_success'];
              unset($_SESSION['add-category_success']);
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['edit-category_success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['edit-category_success'];
              unset($_SESSION['edit-category_success'])
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['edit-category'])): ?>
          <div class="alert-message error">
            <p>
              <?= $_SESSION['edit-category'];
              unset($_SESSION['edit-category'])
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['delete-category_success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['delete-category_success'];
              unset($_SESSION['delete-category_success'])
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['delete-category'])): ?>
          <div class="alert-message error">
            <p>
              <?= $_SESSION['delete-category'];
              unset($_SESSION['delete-category'])
              ?>
            </p>
          </div>
        <?php endif ?>
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>            
          </thead>
          <tbody>
          <?php while($category = mysqli_fetch_assoc($categories)): ?>
            <tr>
              <td><?= "{$category['title']}" ?></td>
              <td><a href="edit-category.php?id=<?= $user['id'] ?>" class="button">Edit</a></td>
              <td><a href="delete-category.php?id=<?= $user['id'] ?>" class="button delete">Delete</a></td>
            </tr>
            <?php endwhile ?>
          </tbody>
        </table>
      </main>
    </div>
  </section>

<?php include '../elements/footer.php' ?>