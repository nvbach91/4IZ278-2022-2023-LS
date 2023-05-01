<?php
session_start();

$errors = [];
$email = "";
$password = "";

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = $_POST["password"];

    if ($email == "") $errors[] = "email is empty";

    if ($password == "") $errors[] = "password is empty";

    if (empty($errors)) {
        require "db/UserDatabase.php";
        $db = new UserDatabase();
        $login = $db->login($email);
        if ($login === 1) {
            setcookie("session", $email, time() + (86400), "/");
            $_SESSION["email"] = $email;
            $_SESSION["userType"] = $db->getUserType($email);

            header("Location: index.php");
            exit();
        } else if ($login === 0) $errors[] = "No login found";
        else $errors[] = "Unknown login error";
    }
}

include "components/header.php";
?>
<main class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 style="padding-bottom: 16px">Login</h2>
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <?php if (!empty($errors)): ?>
                <div>
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif ?>
            <form action="login.php" method="POST">
                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" value="<?php echo $email ?>">
                <br><br>
                <label for="password">Password</label>
                <input id="password" name="password" type="password">
                <br><br>
                <button type="submit" class="btn btn-outline-dark mt-auto">Přihlásit</button>
            </form>
        </div>
    </div>
</main>
<?php include "components/footer.php" ?>
