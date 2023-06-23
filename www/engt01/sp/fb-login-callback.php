<?php

use JanuSoftware\Facebook\Exception\ResponseException;
use JanuSoftware\Facebook\Exception\SDKException;
use JanuSoftware\Facebook\Facebook;

require "vendor/autoload.php";
require_once "fb-config.php";
require_once "db/UserDatabase.php";
session_start();

$fb = new Facebook([
    'app_id' => FB_APP_ID,
    'app_secret' => FB_APP_SECRET,
    'default_graph_version' => 'v2.10'
]);

$helper = $fb->getRedirectLoginHelper();

if (isset($_GET["state"])) {
    $helper->getPersistentDataHandler()->set("state", $_GET["state"]);
}

try {
    $accessToken = $helper->getAccessToken();
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('/me', $accessToken);
} catch(ResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(SDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$userDb = UserDatabase::getInstance();

$email = $response->getDecodedBody()["id"];

if($userDb->register($email, "") === 1) {
    $login = $userDb->login($email, "");
    var_dump($login);
    if ($login === LOGIN_SUCCESS) {
        $_SESSION["userEmail"] = $email;
        $_SESSION["userId"] = $userDb->getUserId($email);
        $_SESSION["userType"] = $userDb->getUserType($userDb->getUserId($email));
    }
} else {
    $_SESSION["userEmail"] = $email;
    $_SESSION["userId"] = $userDb->getUserId($email);
    $_SESSION["userType"] = $userDb->getUserType($userDb->getUserId($email));
}

header("Location: index.php?logged=1");
