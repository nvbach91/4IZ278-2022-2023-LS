<?php
require_once __DIR__ . '/../../../../vendor/autoload.php';
require_once './facebook-config.php';

if (!empty($_GET)) {
    $initCode = $_GET['code'];
    $state = $_GET['state'];

    $facebook = new \JanuSoftware\Facebook\Facebook(
        FACEBOOK_CONFIG
    );
    
    $helper = $facebook->getRedirectLoginHelper();
    $helper->getPersistentDataHandler()->set('state', $state);

    $accessToken = $helper->getAccessToken();
    var_dump($accessToken);

    session_start();
    $_SESSION['access_token'] = $accessToken->getValue();

    header('Location: home.php');
    exit();
}

?>
