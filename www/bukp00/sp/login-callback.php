<?php
require_once __DIR__ . '/vendor/autoload.php';

require_once './config.php';
require_once './database/UsersDB.php';

if (!empty($_GET)) {
    $state = $_GET['state'];

    $facebook = new \JanuSoftware\Facebook\Facebook(
        FB_CONFIG
    );
    $usersDB = new UsersDB();

    $helper = $facebook->getRedirectLoginHelper();
    $helper->getPersistentDataHandler()->set('state', $state);

    $accessToken = $helper->getAccessToken();

    session_start();
    $_SESSION['access_token'] = $accessToken->getValue();

    $fb = new \JanuSoftware\Facebook\Facebook(array_merge(FB_CONFIG, ['default_access_token' => $_SESSION['access_token']]));

    $user = $fb->get('/me')->getGraphNode();

    $userFbId = $user->getField('id');

    $dbUser = $usersDB->getBy('fb_id', $userFbId);

    if ($dbUser) {
        $_SESSION['user_id'] = $dbUser[0]['user_id'];
    } else {
        $usersDB->create(['name' => $user->getField('name'), 'fb_id' => $userFbId]);
        $newUser = $usersDB->getBy('fb_id', $userFbId);
        $_SESSION['user_id'] = $newUser[0]['user_id'];
    }

    header('Location: index.php');
    exit();
}
