<?php 
if (!isset($_SESSION)) session_start();

require_once 'vendor/autoload.php'; 
require_once 'fb_config.php';
require_once 'classes/User.php';
require_once 'classes/Database.php';

$fb = new \JanuSoftware\Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v15.0',
]);

$db = new Database();
$userObj = new User($db);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(FacebookAds\Exception\Exception $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
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

echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

try {
    $response = $fb->get('/me', $accessToken->getValue());
  } catch(\JanuSoftware\Facebook\Exception\ResponseException $e) {

    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(\JanuSoftware\Facebook\Exception\SDKException $e) {

    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  $user = $response->getGraphNode();

  $existingUser = $userObj->getUserByEmail($user->getField('id'));
  
  if (!$existingUser) {
      $hashedPassword = password_hash($user->getField('id'), PASSWORD_DEFAULT);
      $userCreated = $userObj->createUser($user->getField('name'), $user->getField('name'), $user->getField('id'), '', 'user', $hashedPassword, '');
      $userId = $db->getInsertId();
  } else {
      $userId = $existingUser['user_id'];
  }
  
  $_SESSION['user_id'] = $userId;
  $_SESSION['loggedin'] = true;
  
  header('Location: account.php');
  exit;  