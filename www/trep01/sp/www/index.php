<?php
define('__ROOT__', dirname(__FILE__));
$siteTitle = "homepage";


?>

<?php require_once __ROOT__ . "/layout/head.php" ?>


<title>FTP Client - <?= $siteTitle?></title>
<?php require_once __ROOT__ . "/layout/header.php" ?>


<h2>Register</h2>
<form id="formUserRegister" action="/ftpclient/www/action/user/register.php" method="post">
    <div>
        <label>email:</label><br>
        <input type="email" id="user_email" name="user_email" placeholder="email@domain.cz" required><br>
    </div>
    <div>
        <label>password:</label><br>
        <input type="password" id="user_password" name="user_password" placeholder="********" required><br>
    </div>
    <div>
        <label>password repeat:</label><br>
        <input type="password" id="user_password_repeat" name="user_password_repeat" placeholder="********" required><br>
    </div>
    <input type="submit" value="Register me!">
</form>


<h2>Login</h2>
<form id="fromUserLogin" action="/ftpclient/www/action/user/login.php" method="post">
    <div>
        <label>email:</label><br>
        <input type="email" id="user_email" name="user_email" placeholder="XXXXXXXXXXXXXXX" required><br>
    </div>
    <div>
        <label>password:</label><br>
        <input type="password" id="user_password" name="user_password" placeholder="********" required><br>
    </div>
    <input type="submit" value="Log me in!">

</form>

<?php require_once __ROOT__ . "/layout/footer.php" ?>
