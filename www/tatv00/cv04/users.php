<?php

require __DIR__ . '/utils.php';

$profileImagePlaceholder = "https://upload.wikimedia.org/wikipedia/commons/0/07/Big_Floppa_1869.jpg";

$users = getUsers();

?>

<?php include './includes/head.php'; ?>

<main class='container mt-3'>
  <h1 class="text-center">Users business cards</h1>
  <?php foreach ($users as $user) : ?>
    <div class="container mt-3">
      <img class="profileImage" height="200px" src="<?php echo (isset($user['profileImage'])) ?  $user['profileImage'] : $profileImagePlaceholder ?>" alt="profileImage" />
      <div class="data-wrapper">
        <p class="name background">
          <?php echo $user['name'] ?>
        </p>
        <p class="email background">
          <?php echo $user['email'] ?>
        </p>
        <p class="phone">
          <?php echo $user['phone'] ?>
        </p>
      </div>
    </div>
  <?php endforeach; ?>
</main>

<?php include './includes/foot.php'; ?>