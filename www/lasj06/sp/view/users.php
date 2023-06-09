<?php
require '../model/db.php';
require '../controller/user_required.php';
require '../controller/authorization.php';

authorize(3);

?>

<?php require __DIR__ . "/incl/header.php"; ?>
<h1>DiscShop</h1>
<h2>User management page</h2>
<br>

<?php require __DIR__ . "/incl/footer.php"; ?>