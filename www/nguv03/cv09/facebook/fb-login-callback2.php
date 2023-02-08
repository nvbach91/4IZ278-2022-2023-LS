<?php
session_start();

require __DIR__ . '/config.php';

$accessToken = file_get_contents('https://graph.facebook.com/oauth/access_token?' .
    'client_id=' . CONFIG_FACEBOOK['app_id'] .
    '&redirect_uri=' . CONFIG_PROTOCOL . CONFIG_DOMAIN . CONFIG_PATH . '/fb-login-callback2.php' .
    '&client_secret=' . CONFIG_FACEBOOK['app_secret'] .
    '&code=' . $_GET['code']
);

$_SESSION['fb_access_token'] = (string) $accessToken;

?>

<pre><?php echo $accessToken; ?></pre>