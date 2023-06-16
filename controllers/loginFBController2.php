<?php

require_once '../vendor/autoload.php';

require '../config/fb-config.php';


session_start();

$accessToken = file_get_contents(
    'https://graph.facebook.com/oauth/access_token?' .
        'client_id=' . CONFIG_FACEBOOK['app_id'] .
        '&redirect_uri=' . CONFIG_PROTOCOL . CONFIG_DOMAIN . CONFIG_PATH . '/controllers/loginFBController2.php' .
        '&client_secret=' . CONFIG_FACEBOOK['app_secret'] .
        '&code=' . $_GET['code']
);

$_SESSION['fb_access_token'] = (string) $accessToken;

?>

<pre><?php echo $accessToken; ?></pre>