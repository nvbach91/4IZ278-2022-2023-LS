<?php
require_once __DIR__ . '/../vendor/autoload.php';

if (!empty($_GET)) {
    $initCode = $_GET['code'];
    $state = $_GET['state'];

    $facebook = new \JanuSoftware\Facebook\Facebook(
        [
            'app_id' => '275094111529172',
            'app_secret' => 'b078c44b98957c20d9d3174590337a1e',
            'default_graph_version' => 'v2.10',
        ]
    );

    $helper = $facebook->getRedirectLoginHelper();
    $helper->getPersistentDataHandler()->set('state', $state);

    $accessToken = $helper->getAccessToken();
    var_dump($accessToken);

    session_start();
    $_SESSION['access_token'] = !$accessToken ? $accessToken : $accessToken -> getValue() ;

    header('Location: home.php');
    exit();
}

?>