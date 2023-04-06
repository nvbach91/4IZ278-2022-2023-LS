<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

$fb = new \JanuSoftware\Facebook\Facebook(CONFIG_FACEBOOK);

$helper = $fb->getRedirectLoginHelper();

if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']); 
}
?>

<h3>Code</h3>
<p><?php echo $_GET['code']; ?></p>

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
?>
<h3>Access Token</h3>
<pre> <?php var_dump($accessToken->getValue()); ?> </pre>

<?php
// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();
// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
?>
<h3>Metadata</h3>
<pre> <?php var_dump($tokenMetadata); ?> </pre>

<?php
/*
$myAccessToken = file_get_contents('https://graph.facebook.com/oauth/access_token?' .
    'client_id=' . CONFIG_FACEBOOK['app_id'] .
    '&redirect_uri=' . CONFIG_PROTOCOL . CONFIG_DOMAIN . CONFIG_PATH . '/fb-login-callback.php' .
    '&client_secret=' . CONFIG_FACEBOOK['app_secret'] .
    '&code=' . $_GET['code']);
*/
?>

<pre> <?php /* echo $myAccessToken; */ ?> </pre>

<?php
// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId(CONFIG_FACEBOOK['app_id']);
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();
if (!$accessToken->isLongLived()) {
    // Exchanges a short-lived access token for a long-lived one
    try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    } catch (\JanuSoftware\Facebook\Exceptions\FacebookSDKException $e) {
        echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
        exit;
    }
    echo '<h3>Long-lived</h3>';
    var_dump($accessToken->getValue());
}
$_SESSION['fb_access_token'] = (string) $accessToken;
// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
header('Location: profile.php');
?>