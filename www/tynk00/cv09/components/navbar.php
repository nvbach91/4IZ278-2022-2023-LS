<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark sticky-top" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">
      <img src="<?php img('logo.png') ?>" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
      Super e-shop
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Košík <span class="badge rounded-pill text-bg-light"><?php echo count($_SESSION['cart']); ?></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="productManager.php">Správa katalogu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="users.php">Uživatelé</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <?php if (isset($_COOKIE['user'])) : ?>

          <?php $user = $usersDatabase->getLogedUser() ?>
          <div class="d-flex">
            <div class="dropstart">
              <a class="btn btn-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="text-light mx-1 align-text-top">
                  <?php echo $user['username'] ?>
                </span>
                <img src="<?php echo $user['avatar'] ?>" alt="Logo" class="align-text-top rounded-circle" width="30" height="30">
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="profile.php?user=<?php echo $_COOKIE['user'] ?>">Profil</a></li>
                <li><a class="dropdown-item" href="logout.php">Odhlásit se</a></li>
              </ul>


            </div>

          </div>
        <?php else : ?>

          <li class="nav-item">
            <a class="nav-link" href="login.php">Přihlásit se</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Registrace</a>
          </li>
        <?php endif; ?>
      </ul>

    </div>
  </div>
</nav>