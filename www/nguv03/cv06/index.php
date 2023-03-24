<?php require __DIR__ . '/incl/header.php'; ?>

<main class="container">
    <div class="row">
        <div class="col-lg-3">
            <h1 class="my-4">Mango shop</h1>
            <?php require __DIR__ . '/components/CategoryDisplay.php'; ?>
        </div>
        <div class="col-lg-9">
            <?php require __DIR__ . '/components/SlideDisplay.php'; ?>
            <?php require __DIR__ . '/components/ProductDisplay.php'; ?>
        </div>
    </div>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>
