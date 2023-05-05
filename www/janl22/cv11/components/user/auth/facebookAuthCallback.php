<?php

require_once __DIR__ . '/../../../classes/StatusMessage.php';

use classes\User;
use JanuSoftware\Facebook\Exception\ResponseException;
use JanuSoftware\Facebook\Exception\SDKException;
use JanuSoftware\Facebook\Facebook;
use classes\StatusMessage;

function generateErrorMessage(): string {

	return urlencode(base64_encode(json_encode(new StatusMessage('Facebook login failed! Please try again.', 'error'))));

}

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
try {
	$accessToken = $helper->getAccessToken();
} catch (SDKException $e) {
	header('Location: login?message=' . generateErrorMessage());
	exit;
}

if (!isset($accessToken)) {
	header('Location: login?message=' . generateErrorMessage());
	exit;
}

try {
	$user = $fb->get('/me?fields=email,first_name,last_name', $accessToken)->getDecodedBody();
} catch(ResponseException|SDKException $e) {
	header('Location: login?message=' . generateErrorMessage());
	exit;
}

$user = new User($user['email'], $accessToken, $user['first_name'], $user['last_name'], '', ['store.customer']);

setCustomCookie('id_token', generateIdToken($user));
setCustomCookie('access_token', generateAccessToken($user));

Header('Location: home');
exit;