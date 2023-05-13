<?php
// crossmile @ LXSX file:www-html/oauth2/oauth2-init-google.php

require_once(__DIR__ . '/vendor/autoload.php');
// create Client Request to access Google API
$google_client = new Google_Client();
$google_client->setClientId($config['GOOGLE_CLIENT_ID']);
$google_client->setClientSecret($config['GOOGLE_CLIENT_SECRET']);
$google_client->setRedirectUri('https://' . $config['DOMAIN'] . '/' . $config['GOOGLE_CALLBACK_URL']);
$google_client->addScope('email');
$google_client->addScope('profile');
$google_client->addScope('openid');
$google_client->setState($_SESSION['oauth2_state']);
$google_client->setIncludeGrantedScopes(true);
?>