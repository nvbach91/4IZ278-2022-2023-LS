<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once __DIR__ . '/vendor/autoload.php'; ?>
<?php require_once './fbconfig.php'; ?>
<?php

$fb = new Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'public_profile'];
$callbackUrl = 'https://esotemp.vse.cz/~vikd00/sp/fb-login-callback.php';
$loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);

header('Location: ' . $loginUrl);
exit;
