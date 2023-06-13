<?php 
include 'elements/header.php';
include 'elements/dashboard.php';

$current_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE id=$current_id";
$user_result = mysqli_query($db, $user_query);
$user = mysqli_fetch_assoc($user_result);

if ($user['is_admin'] == 1) : {
  $query = "SELECT id, title FROM posts ORDER BY id DESC";
}
else : {
  $query = "SELECT id, title FROM posts WHERE author_id = $current_id ORDER BY id DESC";
}
endif;

$posts = mysqli_query($db, $query);
$titles = "";

?>
      <main>
        <h2>Manage Posts</h2>
        <?php if (isset($_SESSION['add-post_success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['add-post_success'];
              unset($_SESSION['add-post_success']);
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['edit-post_success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['edit-post_success'];
              unset($_SESSION['edit-post_success'])
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['edit-post'])): ?>
          <div class="alert-message error">
            <p>
              <?= $_SESSION['edit-post'];
              unset($_SESSION['edit-post'])
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['delete-post_success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['delete-post_success'];
              unset($_SESSION['delete-post_success'])
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['delete-post'])): ?>
          <div class="alert-message error">
            <p>
              <?= $_SESSION['delete-post'];
              unset($_SESSION['delete-post'])
              ?>
            </p>
          </div>
          <?php elseif (isset($_SESSION['add-post-category success'])): ?>
          <div class="alert-message success">
            <p>
              <?= $_SESSION['add-post-category success'];
              unset($_SESSION['add-post-category success'])
              ?>
            </p>
          </div>
        <?php elseif (isset($_SESSION['add-post-category'])): ?>
          <div class="alert-message error">
            <p>
              <?= $_SESSION['add-post-category'];
              unset($_SESSION['add-post-category'])
              ?>
            </p>
          </div>
        <?php endif ?>
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Add new category</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>            
          </thead>
          <tbody>
            <?php while($post = mysqli_fetch_assoc($posts)): ?>
            <?php
            $post_id = $post['id'];
            $link_query = "SELECT * FROM posts_categories WHERE post_id = $post_id";
            $links = mysqli_query($db, $link_query);
            
            while($link = mysqli_fetch_assoc($links)):

            $category_id = $link['category_id'];
            $category_query = "SELECT title FROM categories WHERE id=$category_id";
            $category_result = mysqli_query($db, $category_query);
            $category = mysqli_fetch_assoc($category_result);
            $titles = $titles . " " . $category['title'];
            ?>
            <tr>
              <td><?= $post['title'] ?></td>
              <td><?= $titles?></td>
              <td><a href="add-category-post.php?id=<?= $post['id'] ?>" class="button">Add</a></td>
              <td><a href="edit-post.php?id=<?= $post['id'] ?>" class="button">Edit</a></td>
              <td><a href="delete-post.php?id=<?= $post['id'] ?>" class="button delete">Delete</a></td>
            </tr>
            <?php endwhile;
            endwhile ?>
          </tbody>
        </table>
      </main>
    </div>
  </section>

<?php include '../elements/footer.php' ?>