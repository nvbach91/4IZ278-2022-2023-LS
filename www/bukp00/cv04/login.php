<?php

require __DIR__ . '/utils.php';

$avatarPlaceholder = "https://avataaars.io/?avatarStyle=Circle&topType=LongHairMiaWallace&accessoriesType=Round&hairColor=Brown&facialHairType=BeardMedium&facialHairColor=Brown&clotheType=ShirtVNeck&clotheColor=Blue03&eyeType=Default&eyebrowType=Angry&mouthType=Twinkle&skinColor=Tanned";

$invalidEmail = false;

$errors = [];

if (!empty($_GET)) {
  $email = trim($_GET['email']);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email = null;
  }
}

if (!empty($_POST)) {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  if ($email == '') {
    $message = 'Email is required.';
    array_push($errors, $message);
  } else {
    $user = getUser($email);
    if ($user != null && $user['password'] != $password) {
      $message = 'Wrong credentials.';
      array_push($errors, $message);
    } else {
      header("Location: users.php");
      exit;
    }
  }
} else {
  $message = 'Please log in.';
  array_push($errors, $message);
}

?>

<?php require './header.php'; ?>

<main class='wrapper'>

  <h1>Business card login form</h1>
  <?php if (!empty($errors)) : ?>
    <div>
      <?php foreach ($errors as $error) : ?>
        <p><?php echo $error; ?></p>
      <?php endforeach; ?>
    </div>
  <?php else : ?>
    <div>
      <p>
        Form submitted successfully
      </p>
    </div>
  <?php endif; ?>

  <form class="person" method="POST" action=<?php echo $_SERVER['PHP_SELF'] ?>>
    <div class="card">
      <img class="avatar" src="<?php echo (isset($avatar) && strlen($avatar) != 0) ? $avatar : $avatarPlaceholder ?>" alt="avatar" />
      <div class="data-wrapper">
        <div class="form-group">
          <label for"email">Email</label>
          <input id="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo isset($email) ? $email : ""; ?>">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" class="form-control" name="password" placeholder="****" type="password">
        </div>
        <input type="submit" value="Login" />
      </div>
    </div>
  </form>
</main>

<?php require './footer.php'; ?>