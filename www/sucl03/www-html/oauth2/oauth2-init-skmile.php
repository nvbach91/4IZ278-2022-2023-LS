<?php
// crossmile @ LXSX file:www-html/oauth2/oauth2-init-skmile.php

require_once(__DIR__ . '/OAuth2simple.php');

$skmile_client = new SkmileOAuth2($config, $db);
$skmile_client->setClientId($config['SKMILE_CLIENT_ID']);
$skmile_client->setClientSecret($config['SKMILE_CLIENT_SECRET']);
$skmile_client->setRedirectUri('https://' . $config['DOMAIN'] . '/' . $config['SKMILE_CALLBACK_URL']);
$skmile_client->addScope('user:r');
$skmile_client->setClientState($_SESSION['oauth2_state']);
?>