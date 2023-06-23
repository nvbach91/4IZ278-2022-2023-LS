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
    $passwordR = $_POST["passwordR"];

    if ($email == "") $errors[] = "Prázdný email";
    if ($password == "") $errors[] = "Prázdné heslo";
    if ($password != $passwordR) $errors[] = "Hesla nejsou stejná";

    if (empty($errors)) {
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $result = $userDb->register($email, $passHash);

        if ($result === 1) {
            $errors[] = "Email je již používán.";
        } else if ($result === 0) {
            $_SESSION["userEmail"] = $email;
            $_SESSION["userId"] = $userDb->getUserId($email);
            $_SESSION["userType"] = $userDb->getUserType($userDb->getUserId($email));

            mail($email, "Registrace do Knihovny 4IZ278", "Dobrý den,\nVaše registrace na https://esotemp.vse.cz/~engt01/sp/ proběhla úspěšně!");

            header("Location: index.php?registered=1");
            exit();
        } else $errors[] = "No login found";
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
            <h2 class="card-title">Registrovat se</h2>
            <form action="register.php" method="POST" class="register-grid" style="gap: 8px">
                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" value="<?php echo $email ?>">
                <label for="password">Heslo</label>
                <input id="password" name="password" type="password">
                <label for="passwordR">Potvrdit heslo</label>
                <input id="passwordR" name="passwordR" type="password">
                <button type="submit" class="btn btn-primary mt-auto" style="grid-column: 1 / span 2">Registrovat
                </button>
            </form>
        </div>
    </div>
</main>
<?php include "components/footer.php" ?>

