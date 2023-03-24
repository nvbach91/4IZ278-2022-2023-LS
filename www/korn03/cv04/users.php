<?php

require ("./utils.php");


$users = getUsers();

?>

<?php include './head.php'; ?>

<main class='container mt-3'>
  <h1 class="text-center">Users</h1>
  <ul>
  <?php foreach ($users as $user) : ?>
    <li><?php echo $user["firstName"]?>|<?php echo $user["lastName"]?>|<?php echo $user["mail"]?></li>
  <?php endforeach; ?>
  </ul>
</main>

<?php include './foot.php'; ?>
