<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once 'config.php';

$fb = new \JanuSoftware\Facebook\Facebook([
    "app_id" => CONFIG_FACEBOOK["app_id"],
    "app_secret" => CONFIG_FACEBOOK["app_secret"],
    "default_graph_version" => CONFIG_FACEBOOK["default_graph_version"],
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'public_profile'];
$callback = 'https://esotemp.vse.cz/~kulm11/sp/fb-login-callback.php';
$loginUrl = $helper->getLoginUrl($callback, $permissions);

try {
    $loginUrl = $helper->getLoginUrl($callback, $permissions);
    header('Location: ' . $loginUrl);
    exit;
} catch (\JanuSoftware\Facebook\Exception\SDKException $e) {
    echo 'Facebook SDK Error: ' . $e->getMessage();
}