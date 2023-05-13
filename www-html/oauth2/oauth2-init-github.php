<?php
// crossmile @ LXSX file:www-html/oauth2/oauth2-init-github.php

require_once(__DIR__ . '/OAuth2simple.php');

$github_client = new GithubOAuth2($config, $db);
$github_client->setClientId($config['GITHUB_CLIENT_ID']);
$github_client->setClientSecret($config['GITHUB_CLIENT_SECRET']);
$github_client->setRedirectUri('https://' . $config['DOMAIN'] . '/' . $config['GITHUB_CALLBACK_URL']);
$github_client->addScope('read:user');
$github_client->addScope('user:email');
$github_client->setClientState($_SESSION['oauth2_state']);
?>