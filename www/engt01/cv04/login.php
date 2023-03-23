<?php
require_once "functions.php";

$email = "";
$password = "";
$loginStatus = -1;

if (isset($_GET["email"])) {
    $email = $_GET["email"];

    $errors[] = "registrace úspěšná";
}

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = $_POST["password"];

    $loginStatus = auth($email, $password);
}

require "header.php"; ?>
    <h1>Login form</h1>
<?php if (isset($_GET["email"])): ?>
    <div>Úspěšně registrováno.</div><br>
<?php endif;
switch ($loginStatus):
    case 0: ?>
        <div style="color: green">User logged in</div><br>
        <?php break;
    case 1: ?>
        <div style="color: red">No user found</div><br>
        <?php break;
    case 2: ?>
        <div style="color: red">Wrong password</div><br>
        <?php break;
    default:
        break;
endswitch; ?>
    <form action="./login.php" method="POST">
        <label for="email">E-mail</label>
        <input id="email" name="email" type="email" value="<?php echo $email ?>">
        <br><br>
        <label for="password">Password</label>
        <input id="password" name="password" type="password">
        <br><br>
        <button>Login</button>
    </form>
<?php require "footer.php";
