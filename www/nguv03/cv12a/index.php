<?php 

require_once __DIR__ . '/vendor/autoload.php';

const CONFIG_FACEBOOK = [
    'app_id' => '',
    'app_secret' => '',
    'default_graph_version' => 'v2.10',
];

$facebook = new \JanuSoftware\Facebook\Facebook(CONFIG_FACEBOOK);

$helper = $facebook->getRedirectLoginHelper();
$permissions = ['email'];
$redirectUrl = $helper->getLoginUrl(
    'http://localhost/4IZ278-2022-2023-LS/www/nguv03/cv12a/facebook-login-callback.php',
    $permissions
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
    <h1>Facebook OAuth DEMO</h1>
    <a href="<?php echo $redirectUrl; ?>">Facebook Login</a>
</body>
</html>