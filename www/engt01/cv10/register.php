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

    if (empty($errors)) {
        require "db/UserDatabase.php";
        $db = new UserDatabase();
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $result = $db->register($email, $passHash);
        $login = $db->login($email);
        $loginCount = count($login);
        $loginHash = $login[0]["hash"];
        if ($loginCount === 1 && $passHash === $loginHash) {
            if ($result === 0) {
                setcookie("session", $email, time() + (86400), "/");
                $_SESSION["email"] = $email;
                $_SESSION["userType"] = $db->getUserType($email);

                header("Location: index.php?registered");
            } else if ($result === 1) $errors[] = "Email already registered";
            else $errors[] = "Unknown login error";
        } else $errors[] = "Database error";
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
