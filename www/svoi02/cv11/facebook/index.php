<?php 
require __DIR__ . '/../vendor/autoload.php';
require './facebook-config.php';


$facebook = new \JanuSoftware\Facebook\Facebook(
    FACEBOOK_CONFIG
);

$helper = $facebook->getRedirectLoginHelper();
$loginUrl = $helper->getLoginUrl(
    'http://localhost/cv11/facebook-login-callback.php',
    ['email'],
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Faceboon login</h1>
    <a href="<?php echo $loginUrl;?>">Login</a>
</body>
</html>