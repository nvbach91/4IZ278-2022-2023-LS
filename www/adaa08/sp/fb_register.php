<?php 
if (!isset($_SESSION)) session_start();

require_once 'vendor/autoload.php'; 
require_once 'fb_config.php';

$fb = new \JanuSoftware\Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v15.0',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'public_profile']; 

$callbackUrl = htmlspecialchars('https://esotemp.vse.cz/~adaa08/sp/fb_callback.php');
$loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);

header('Location: ' . $loginUrl );
exit;
?>
