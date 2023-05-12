<?php

require __DIR__ . '/../vendor/autoload.php';
require_once './facebook_config.php';
use \JanuSoftware\Facebook\Facebook;

$fb = new \JanuSoftware\Facebook\Facebook(FACEBOOK_CONFIG);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl(
    'http://localhost/facebook/facebook_login_callback.php',
    ['email'],
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="mangomaniac, mango, mango, mango">
    <meta name="author" content="Nguyen Viet Bach">
    <title>Mango Shop | Mangomaniac Inc.</title>
    <link rel="shortcut icon" href="https://cdn.iconscout.com/icon/free/png-256/mango-fruit-vitamin-healthy-summer-food-31184.png">
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
</head>

<body>
    <header></header>
    <main class="container d-flex flex-column align-items-center justify-content-center" style="height: 500px;">
        <a class="btn btn-primary" href="<?php echo htmlspecialchars($loginUrl); ?>" style='background-color: blue;'>Log in with Facebook!</a>
        <p>You will be redirected to Facebook to sign in. Once signed in you will come back to us :)</p>
    </main>
    <footer></footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>

</html>