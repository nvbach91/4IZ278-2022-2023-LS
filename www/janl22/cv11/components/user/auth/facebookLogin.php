<?php

use JanuSoftware\Facebook\Exception\SDKException;
use JanuSoftware\Facebook\Facebook;

try {
	$fb = new Facebook([
		'app_id' => FACEBOOK_APP_ID,
		'app_secret' => FACEBOOK_APP_SECRET,
		'default_graph_version' => FACEBOOK_GRAPH_VERSION,
	]);
} catch (SDKException $e) {

	require_once __DIR__ . '/../../../templates/500.php';

}

$helper = $fb->getRedirectLoginHelper();
$callBackUrl = PRODUCTION ? FACEBOOK_CALLBACK_URL : 'http://localhost/' . $GLOBALS['siteRoot'] . FACEBOOK_CALLBACK_URL_LOCAL;
$loginUrl = $helper->getLoginUrl($callBackUrl, FACEBOOK_REQUIRED_CLAIMS);

header('Location: ' . $loginUrl);
exit;