<?php if (!isset($_SESSION)) session_start(); ?>

<?php require './header.php' ?>
<?php require './navbar.php'; ?>
<?php require './spotlight.php'; ?>

<div class="d-flex align-items-center justify-content-center mt-5">
    <h2 class="mb-0">Vyhľadajte svoje vozidlo snov... </h2>
    <img class="logo-small d-inline-block align-text-top ms-4" src="./redrive_logo_text.png" alt="ReDrive Logo">
</div>

<div class="mx-5">
    <?php require './search-form.php'; ?>
</div>

<?php require './footer.php' ?>