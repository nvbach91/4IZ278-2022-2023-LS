<?php require './components/header.php'; ?>

<?php

error_reporting(E_ERROR | E_PARSE);

if (!empty($_POST)) {
  $username = @$_POST['username'];
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie("username", $_POST['username'], time() + 3600);
    header('Location: index.php');
    exit();
  }
}

?>

<main class="login-form">
  <h3>Login</h3>
  <form method="POST">
    <input placeholder="Enter username" name="username">
    <button type="submit" class="btn btn-outline-dark">Log in</button>
  </form>
</main>

<?php require './components/footer.php'; ?>