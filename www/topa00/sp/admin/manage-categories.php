<?php 
include 'elements/header.php';
include 'elements/dashboard.php';

$category_query = "SELECT * FROM categories ORDER BY title";
$category_result = $db->prepare($category_query);
$category_result->execute();
$categories = $category_result->fetchAll(PDO::FETCH_ASSOC);
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
        <?php elseif (isset($_SESSION['edit-category success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['edit-category success'];
              unset($_SESSION['edit-category success'])
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
        <?php elseif (isset($_SESSION['delete-category success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['delete-category success'];
              unset($_SESSION['delete-category success'])
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
          <?php foreach ($categories as $category): ?>
            <tr>
              <td><?= "{$category['title']}" ?></td>
              <td><a href="edit-category.php?id=<?= $category['id'] ?>" class="button">Edit</a></td>
              <td><a href="delete-category.php?id=<?= $category['id'] ?>" class="button delete">Delete</a></td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </main>
    </div>
  </section>

<?php include '../elements/footer.php' ?>