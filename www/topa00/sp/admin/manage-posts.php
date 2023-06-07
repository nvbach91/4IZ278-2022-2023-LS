<?php 
include 'elements/header.php';
include 'elements/dashboard.php';

$current_id = $_SESSION['user_id'];

$query = "SELECT id, title, category_id FROM posts WHERE author_id = $current_id ORDER BY id DESC";
$posts = mysqli_query($db, $query);
?>
      <main>
        <h2>Manage Posts</h2>
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>            
          </thead>
          <tbody>
            <?php while($post = mysqli_fetch_assoc($posts)): ?>
            <?php
            $category_id = $post['category_id'];
            $category_query = "SELECT title FROM categories WHERE id=$category_id";
            $category_result = mysqli_query($db, $category_query);
            $category = mysqli_fetch_assoc($category_result);
            ?>
            <tr>
              <td><?= $post['title'] ?></td>
              <td><?= $category['title']?></td>
              <td><a href="edit-post.php?id=<?= $post['id'] ?>" class="button">Edit</a></td>
              <td><a href="delete-post.php?id=<?= $post['id'] ?>" class="button delete">Delete</a></td>
            </tr>
            <?php endwhile ?>
          </tbody>
        </table>
      </main>
    </div>
  </section>

<?php include '../elements/footer.php' ?>