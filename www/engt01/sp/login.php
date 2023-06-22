<?php
require_once "db/BooksDatabase.php";
require_once "db/CategoriesDatabase.php";
require_once "db/UserDatabase.php";
session_start();

if (isset($_SESSION["userType"])) header("Location: index.php");

$bookDb = BooksDatabase::getInstance();
$catDb = CategoriesDatabase::getInstance();
$userDb = UserDatabase::getInstance();

$errors = [];
$email = "";

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = $_POST["password"];

    if ($email == "") $errors[] = "Prázdný email";
    if ($password == "") $errors[] = "Prázdné heslo";

    if (empty($errors)) {
        $login = $userDb->login($email, $password);
        if ($login === LOGIN_SUCCESS) {
            $_SESSION["userEmail"] = $email;
            $_SESSION["userId"] = $userDb->getUserId($email);
            $_SESSION["userType"] = $userDb->getUserType($userDb->getUserId($email));

            header("Location: index.php?logged=1");
            exit();
        } else if ($login === LOGIN_FAIL) $errors[] = "Špatný email nebo heslo";
        else $errors[] = "Neexistující účet";
    }
}

if (isset($_SESSION["userEmail"])) header("Location: index.php");

include "components/header.php" ?>
<main class="mx-4 mx-auto d-flex flex-column">
    <?php if (!empty($errors)): ?>
        <div class="text-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
    <div class="card my-2">
        <div class="card-body">
            <h2 class="card-title">Přihlásit se</h2>
            <form action="login.php" method="POST" class="login-grid" style="gap: 8px">
                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" value="<?php echo $email ?>">
                <label for="password">Heslo</label>
                <input id="password" name="password" type="password">
                <button type="submit" class="btn btn-primary mt-auto" style="grid-column: 1 / span 2">Přihlásit</button>
            </form>
        </div>
    </div>
</main>
<?php include "components/footer.php" ?>

