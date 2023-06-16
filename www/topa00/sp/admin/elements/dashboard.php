<section class="dashboard" class="active">
    <div class="container dashboard-container">
      <aside>
        <ul>
          <li>
            <a href="dashboard.php">
              <img src="../images/dashboard.png">
              <h5>Dashboard</h5>
            </a>
          </li>
          <li>
            <a href="add-post.php">
              <img src="../images/edit.png">
              <h5>Add Post</h5>
            </a>
          </li>
          <li>
            <a href="manage-posts.php">
              <img src="../images/posts.png">
              <h5>Manage Post</h5>
            </a>
          </li>
          <?php if(isset($_SESSION['user_is_admin'])) : ?>
          <li>
            <a href="add-user.php">
              <img src="../images/user.png">
              <h5>Add User</h5>
            </a>
          </li>
          <li>
            <a href="manage-users.php">
              <img src="../images/users.png">
              <h5>Manage Users</h5>
            </a>
          </li>
          <li>
            <a href="add-category.php">
              <img src="../images/category.png">
              <h5>Add Category</h5>
            </a>
          </li>
          <li>
            <a href="manage-categories.php">
              <img src="../images/categories.png">
              <h5>Manage Categories</h5>
            </a>
          </li>
          <?php endif; ?>
        </ul>
      </aside>