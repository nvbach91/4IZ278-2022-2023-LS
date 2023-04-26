<?php

if (isset($loggedUser)) {
  $logged = $usersDatabase->getLoggedUser($loggedUser);
}
else {
  $logged = null;
}

?>


<nav class="navbar navbar-expand-lg text-bg-dark sticky-top shadow-sm" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand me-1" href="home.php">
      <img src="<?php img('logo.png') ?>" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
      Foodcade
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <div class="h-100 mx-2" role="separator" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; width: 3px;"></div>
        </li>

        <li class="nav-item">
          <a class="nav-link btn btn-dark bg-body-secondary px-3" href="home.php"><i class="fa fa-book" aria-hidden="true"></i> Prohlížení katalogu</a>
        </li>

        <li class="nav-item">
          <a class="nav-link btn btn-dark bg-body-secondary px-3 ms-1" href="users.php"><i class="fa fa-user" aria-hidden="true"></i> Přehled uživatelů</a>
        </li>

        <li class="nav-item">
          <div class="h-100 mx-2" role="separator" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; width: 3px;"></div>
        </li>

        <?php if (isset($logged)) : ?>
          <?php if ($usersDatabase->isManager($logged)) : ?>
            <li class="nav-item">
              <a class="nav-link btn btn-dark bg-body-secondary px-3 me-1" href="databaseManager.php"><i class="fa fa-book" aria-hidden="true"></i> Správa databáze</a>
            </li>
          <?php endif; ?>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link btn btn-dark bg-body-secondary px-3" href="world-clock.php"><i class="fa fa-clock-o" aria-hidden="true"></i> Světový čas</a>
        </li>
      </ul>
      <div class="d-flex">
        <ul class="navbar-nav">
          <li class="nav-item btn btn-dark bg-body-secondary p-0 px-2">
            <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Košík <span class="badge text-bg-light"><?php echo count($_SESSION['cart']); ?></span></a>
          </li>
          <li class="nav-item">
            <div class="h-100 mx-2" role="separator" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; width: 3px;"></div>
          </li>
          <?php if (isset($logged)) : ?>
            <div class="dropstart">
              <a class="btn btn-dark bg-body-secondary px-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="text-light mx-1 align-text-top">
                  <?php echo $logged['username'] ?>
                </span>
                <img src="<?php echo $logged['avatar'] ?>" alt="Logo" class="align-text-top rounded-circle" onerror="this.src='<?php img('avatar-placeholder.jpeg'); ?>';" width="30" height="30">
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="profile.php?user=<?php echo $logged['user_id'] ?>">Profil</a></li>
                <li><a class="dropdown-item disabled" href="logout.php">Nastavení</a></li>
                <li><a class="dropdown-item" href="logout.php">Odhlásit se</a></li>
              </ul>


            </div>
          <?php else : ?>

            <li class="nav-item">
              <a class="nav-link btn btn-dark bg-body-secondary px-3" href="login.php">Přihlásit se</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-dark bg-body-secondary px-3 ms-1" href="register.php">Registrace</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</nav>