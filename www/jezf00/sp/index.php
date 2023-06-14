<?php require __DIR__ . '/header.php'; ?>


    
<div class="container mt-3">
    <?php require __DIR__ . '/navbar.php'; ?>
    <div class="row">
      <div class="col-lg-3">
        <h3 class="mb-4">Categories</h3>
        <?php require_once "./categoryDisplay.php" ?>
      </div>
      <div class="col-lg-9">
        <h3 class="mb-4">Products</h3>
        <?php require_once __DIR__ . '/productDisplay.php'; ?>
      </div>
    </div>
  </div>
</body>

<?php require __DIR__ . '/footer.php'; ?>
