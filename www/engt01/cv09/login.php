<?php
session_start();

$errors = [];
$email = "";
$name = "";
$password = "";

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST["email"]));
    $name = htmlspecialchars(trim($_POST["name"]));
    $password = $_POST["password"];

    if ($email == "") $errors[] = "email is empty";
    if ($name == "") $errors[] = "name is empty";
    if ($password == "") $errors[] = "password is empty";

    if (empty($errors)) {
        setcookie("session", $email, time() + (86400), "/");
        header("Location: index.php");
    }
}

include "components/header.php";
?>
<main class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <?php if (!empty($errors)): ?>
                <div>
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif ?>
            <form action="./login.php" method="POST">
                <label for="name">Name*</label>
                <input id="name" name="name" type="text" value="<?php echo $name ?>">
                <br><br>
                <label for="email">E-mail*</label>
                <input id="email" name="email" type="email" value="<?php echo $email ?>">
                <br><br>
                <label for="password">Password*</label>
                <input id="password" name="password" type="password">
                <br><br>
                <button class="btn btn-outline-dark mt-auto">Přihlásit</button>
            </form>
        </div>
    </div>
</main>
<?php include "components/footer.php" ?>
