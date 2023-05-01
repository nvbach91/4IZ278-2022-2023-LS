<?php
session_start();

$errors = [];
$email = "";
$password = "";
$passwordR = "";

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = $_POST["password"];
    $passwordR = $_POST["passwordR"];

    if ($email == "") $errors[] = "email is empty";

    if ($password == "") $errors[] = "password is empty";

    if ($password != $passwordR) $errors[] = "passwords do not match";

//    if (empty($errors))

    if (empty($errors)) {
        require "db/UserDatabase.php";
        $db = new UserDatabase();
        $result = $db->register($email, password_hash($password, PASSWORD_DEFAULT));
        if ($result === 0) {
            header("Location: index.php?registered");
        } else if ($result === 1) {
            $errors[] = "email already registered";
        } else $errors[] = "Unknown login error";
    }
}

include "components/header.php";
?>
<main class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 style="padding-bottom: 16px">Register</h2>
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <?php if (!empty($errors)): ?>
                <div>
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif ?>
            <form action="register.php" method="POST">
                <label for="email">E-mail*</label>
                <input id="email" name="email" type="email">
                <br><br>
                <label for="password">Password*</label>
                <input id="password" name="password" type="password">
                <br><br>
                <label for="passwordR">Confirm password*</label>
                <input id="passwordR" name="passwordR" type="password">
                <br><br>
                <button type="submit" class="btn btn-outline-dark mt-auto">Register</button>
            </form>
        </div>
    </div>
</main>
<?php include "components/footer.php" ?>
