<?php

require __DIR__ . '/utils.php';

$avatarPlaceholder = "https://avataaars.io/?avatarStyle=Circle&topType=LongHairMiaWallace&accessoriesType=Round&hairColor=Brown&facialHairType=BeardMedium&facialHairColor=Brown&clotheType=ShirtVNeck&clotheColor=Blue03&eyeType=Default&eyebrowType=Angry&mouthType=Twinkle&skinColor=Tanned";

$users = getUsers();

?>

<?php require './header.php'; ?>

<main class='wrapper'>

  <h1>Users business cards</h1>
  <?php foreach ($users as $user) : ?>
    <div class="users-list">
      <div class="card">
        <img class="avatar" src="<?php echo (isset($avatar) && strlen($avatar) != 0) ? $avatar : $avatarPlaceholder ?>" alt="avatar" />
        <div class="data-wrapper">
          <p class="name background">
            <?php echo $user['name'] ?>
          </p>
          <p class="email background">
            <?php echo $user['email'] ?>
          </p>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</main>

<?php require './footer.php'; ?>