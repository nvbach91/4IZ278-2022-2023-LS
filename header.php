<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <a href="index.php" style="color:white; margin-left: 10px;">KitchenStore</a>
    </li>
    <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
  </ul>

  <section class="top-bar-section">
    <ul class="right">
      <li><a href="index.php">Domov</a></li>
      <li><a href="product.php">E-shop</a></li>
      <li><a href="cart.php">Košík</a></li>
      <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
          echo '<li><a href="account.php">Môj účet</a></li>';
          if(isset($_SESSION["role"]) && $_SESSION["role"] === "admin") {
            echo '<li><a href="admin.php">Admin Panel</a></li>';
          }
          echo '<li><a href="logout.php">Odhlásiť sa</a></li>';
        } else {
          echo '<li><a href="login.php">Prihlásiť sa</a></li>';
          echo '<li><a href="register.php">Registrácia</a></li>';
        }
      ?>
    </ul>
  </section>
</nav>
