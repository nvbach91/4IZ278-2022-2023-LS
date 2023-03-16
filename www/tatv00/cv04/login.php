<?php

require __DIR__ . '/utils.php';

$avatarPlaceholder = "";

$invalidEmail = false;

$invalidInputs = [];
$alertMessages = [];

if (!empty($_GET)) {
  $email = trim($_GET['email']);
}

$submittedForm = !empty($_POST);
if ($submittedForm) {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  if (!preg_match('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/', $email)) {
    $alertMessage = 'Email is required.';
    array_push($invalidInputs, $alertMessage);
  } else {
    $user = getUser($email);
    if ($user['email'] != $email || $user['password'] != $password) {
      $alertMessage = 'Wrong credentials.';
      array_push($invalidInputs, $alertMessage);
    } else {
      header("Location: users.php");
      exit;
    }
  }
} else {
  $alertMessage = 'Please log in.';
  array_push($invalidInputs, $alertMessage);
}

if (!count($invalidInputs)) {
        $alertType = 'alert-success';
        $invalidInputs = ['Woohoo! You have successfully signed up!'];
}
  else {
        $alertType = 'alert-danger';
    }

?>

<?php include './includes/head.php'; ?>

<main class='container mt-3'>

  <h1>Business card login form</h1>
  <div class="container mt-3">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php if ($submittedForm): ?>
            <div class="alert <?php echo $alertType; ?>">
            <?php echo implode('<br>', $invalidInputs); ?>
            </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">E-mail</label>
                <input id="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo isset($email) ? $email : ""; ?>">
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input id="password" class="form-control" name="password" placeholder="****" type="password">
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-info">Login</button>
            </div>
        </form>
    </div>
</main>

<?php include './includes/foot.php'; ?>