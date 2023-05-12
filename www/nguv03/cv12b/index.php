<?php 

require __DIR__ . '/vendor/autoload.php';
require './facebook-config.php';

var_dump(FACEBOOK_CONFIG);
$facebook = new \JanuSoftware\Facebook\Facebook(
    FACEBOOK_CONFIG
);

$helper = $facebook->getRedirectLoginHelper();
$loginUrl = $helper->getLoginUrl(
    'http://localhost/4IZ278-2022-2023-LS/www/nguv03/cv12b/facebook-login-callback.php',
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
    <h1>Facebook login</h1>
    <a href="<?php echo $loginUrl; ?>">Click here to login</a>
</body>
</html>