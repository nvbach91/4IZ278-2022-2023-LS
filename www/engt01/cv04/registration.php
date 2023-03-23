<?php
require_once "functions.php";

$errors = [];
$email = "";
$name = "";
$password = "";
$passwordR = "";

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST["email"]));
    $name = htmlspecialchars(trim($_POST["name"]));
    $password = $_POST["password"];
    $passwordR = $_POST["passwordR"];

    if ($email == "") $errors[] = "email is empty";

    if ($name == "") $errors[] = "name is empty";

    if ($password == "") $errors[] = "password is empty";

    if ($password != $passwordR) $errors[] = "passwords do not match";

    if (empty($errors) && registerNewUser($_POST)) $errors[] = "email already registered";

    if (empty($errors)) {
        mail($email, "Registration to eso.vse.cz", "Your registration to https://eso.vse.cz is now complete!");
        header("Location: login.php?email=" . $email);
        exit;
    }
}

require "header.php" ?>
<h1>Registration form</h1>
<?php if (!empty($errors)): ?>
    <div>
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error ?></p>
        <?php endforeach; ?>
    </div>
<?php elseif (!empty($_POST)): ?>
    <div>Úspěšně registrováno.</div><br>
<?php endif; ?>
<form action="./registration.php" method="POST">
    <label for="name">Name*</label>
    <input id="name" name="name" type="text" value="<?php echo $name ?>">
    <br><br>
    <label for="email">E-mail*</label>
    <input id="email" name="email" type="email" value="<?php echo $email ?>">
    <br><br>
    <label for="password">Password*</label>
    <input id="password" name="password" type="password">
    <br><br>
    <label for="passwordR">Confirm password*</label>
    <input id="passwordR" name="passwordR" type="password">
    <br><br>
    <button>Register</button>
</form>
<?php require "footer.php";
