<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once __DIR__ . '/vendor/autoload.php'; ?>
<?php require_once './fbconfig.php'; ?>
<?php require_once './UserDatabase.php'; ?>
<?php
$fb = new Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    header('Location: ./index.php');
    exit;
}

try {
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$user = $response->getGraphUser();
$fbId = $user->getField('id');
$fbEmail = $user->getField('email');
$fbName = $user->getField('name');


$db = new UserDatabase();
if ($db->getUserByFbId($fbId)) {
    $_SESSION['user'] = $db->getUserByFbId($fbId);
} else {
    $db->registerUserFromFb($fbId, $fbEmail, $fbName);
    $_SESSION['user'] = $db->getUserByFbId($fbId);
}

echo '<script>window.location.href="./index.php";</script>';
exit;
