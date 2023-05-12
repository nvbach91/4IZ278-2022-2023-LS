<?php

require_once __DIR__ . '/vendor/autoload.php';

const CONFIG_FACEBOOK = [
    'app_id' => '',
    'app_secret' => '',
    'default_graph_version' => 'v2.10',
];
session_start();
var_dump($_SESSION);
if (!empty($_GET)) {
    // var_dump($_GET);
    $initCode = $_GET['code'];

    // var_dump($initCode);
    // session_start();
    $_SESSION['facebook_init_code'] = $initCode;
    

    $facebook = new \JanuSoftware\Facebook\Facebook(CONFIG_FACEBOOK);
    $helper = $facebook->getRedirectLoginHelper();
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
    // access token
    $accessToken = $helper->getAccessToken();
    // var_dump($accessToken->getValue());
    $_SESSION['facebook_access_token'] = $accessToken->getValue();
    header('Location: home.php');
}



?>