<?php require_once __DIR__ . '/incl/header.php'; ?>
<?php require_once __DIR__ . '/database/UsersDB.php'; ?>
<?php

//Verifies user input and if successful logs user in otherwise displays an error message
if (!empty($_POST) && isset($_POST['email']) && isset($_POST['password'])&&filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $database = UsersDB::getDatabase();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = $database->verifyLogin($email, $password);
    if ($result == 1) {
        setcookie('user_email', $email, time() + 3600);
        $_SESSION['logged_in'] = 1;
        header('Location: ./index.php');
        exit;
    } else {
        echo "<div style='background-color:red;color:white;text-align:center;'><a>Email or password is incorrect.</a></div>";
    }
}

//Block creating Log in with facebook button
require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

$fb = new \JanuSoftware\Facebook\Facebook(CONFIG_FACEBOOK);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl(CONFIG_PROTOCOL . CONFIG_DOMAIN . CONFIG_PATH . '/fb-login-callback.php', $permissions);


?>



<div style="margin-left:auto;margin-right:auto;width:60%;max-width:300px;">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <h1 style="text-align:center;padding-bottom:30px;">Login page</h1>
        <input class="form-control mr-sm-2" required style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;" name="email" type="email" placeholder="Email">
        <input class="form-control mr-sm-2" required style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;" name="password" type="password" placeholder="Password">
        <a style="display:block;margin-top:-30px;margin-bottom:30px;" href="signup.php">Don't have an account yet? Sign up here!</a>
        <button class="btn" style="display:block;margin-left:auto;margin-right:auto;">Login</button>
        <a class="fb-log-wrap" href="#"><div class="fb-login"><img src="https://www.facebook.com/images/fb_icon_325x325.png" alt="fb-logo"><a href='<?php echo htmlspecialchars($loginUrl); ?>'>Log in using Facebook</a></div></a>
    </form>
</div>
<?php require_once __DIR__ . '/incl/footer.php'; ?>