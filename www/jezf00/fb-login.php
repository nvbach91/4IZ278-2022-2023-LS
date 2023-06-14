<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once 'fbconfig.php';

$fb = new \JanuSoftware\Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'public_profile'];
$callbackUrl = 'https://esotemp.vse.cz/~jezf00/sp/code/fb-login-callback.php';
$loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);

try {
    
    $loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);

    
    header('Location: ' . $loginUrl);
    exit;
} catch (\JanuSoftware\Facebook\Exception\SDKException $e) {
    
    echo 'Facebook SDK Error: ' . $e->getMessage();
}
