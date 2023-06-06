<?php
require '../model/db.php';
require '../controller/user_required.php';
require '../controller/authorization.php';

authorize(1);

?>

<?php require __DIR__ . "/incl/header.php"; ?>
<h1>DiscShop</h1>
<h2>This is the cart</h2>
<br>

<?php require __DIR__ . "/incl/footer.php"; ?>