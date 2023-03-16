<?php
require "utils.php";

$mail = isset($_GET['mail']) ? $_GET['mail'] : '';


if (!empty($_POST)) {
    authenticate();
}

?>


<?php include "head.php"; ?>
<a href="index.php">Don't have an account?</a>
<h1>Login</h1>
<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div>
        <label>E-mail</label>
        <input type="email" name="mail">
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <button>Submit</button>
</form>
<?php include "foot.php"; ?>