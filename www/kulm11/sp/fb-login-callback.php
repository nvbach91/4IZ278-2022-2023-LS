<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';
require_once "./database/UsersDatabase.php";

$userDB = new UsersDatabase();

$fb = new \JanuSoftware\Facebook\Facebook([
    "app_id" => CONFIG_FACEBOOK["app_id"],
    "app_secret" => CONFIG_FACEBOOK["app_secret"],
    "default_graph_version" => CONFIG_FACEBOOK["default_graph_version"],
]);

$helper = $fb->getRedirectLoginHelper();

if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']); 
}
?>

<?php
try {
    $accessToken = $helper->getAccessToken();
} catch(\JanuSoftware\Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(\JanuSoftware\Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

$_SESSION["access_token"] = $accessToken;

try{
    $response = $fb->get("/me?fields=first_name,last_name,email", $accessToken);
    $fbUser = $response->getGraphNode();
    $email = $fbUser->getField("email");
    $firstName = $fbUser->getField("first_name");
    $lastName = $fbUser->getField("last_name");

    setcookie("username", $email, time()+3600);
    setcookie("first_name", $firstName, time()+3600);
    setcookie("last_name", $lastName, time()+3600);

    if(!$userDB->checkEmail($email)){
        header('Location: ./changeProfile.php');
    }
    else{
        header('Location: ./index.php');
    }
    exit;
} catch (\JanuSoftware\Facebook\Exception\ResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (\JanuSoftware\Facebook\Exception\SDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
?>