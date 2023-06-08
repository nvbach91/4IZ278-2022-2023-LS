<?php
session_start();

if (!isset($_SESSION['fb_access_token'])) {
    header('Location: ./index.php');
    exit();
}

require_once './vendor/autoload.php';
require './config.php';

$fb = new \JanuSoftware\Facebook\Facebook(array_merge(CONFIG_FACEBOOK, ['default_access_token' => $_SESSION['fb_access_token']]));
try {
    $me = $fb->get('/me?locale=en_US&fields=name,email,location')->getGraphNode();
} catch (\JanuSoftware\Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (\JanuSoftware\Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

require_once('./database/UsersDB.php');
$usersDB = UsersDB::getDatabase();
$userEmail = htmlspecialchars($me->getField('email'));
if ($usersDB->userExists($userEmail)) {
    setcookie('user_email', $userEmail, time() + 3600);
    $_SESSION['logged_in'] = 1;
    header('Location: ./index.php');
    exit;
}else{
    $result=$usersDB->registerUser(htmlspecialchars($me->getField('name')), $userEmail, $_SESSION['fb_access_token'], htmlspecialchars(($me->getField('location')!=NULL)?$me->getField('location'):"Facebook"));
    if ($result == null) {
        setcookie("user_email", $userEmail, time() + 3600);
        $_SESSION['logged_in'] = 1;
        header('Location: ./index.php');
        exit;
    } else {
        echo $result;
    }
}
