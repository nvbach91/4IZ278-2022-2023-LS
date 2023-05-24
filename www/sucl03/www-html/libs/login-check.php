<?php
// crossmile @ LXSX file:www-html/libs/login-check.php

// init session if not active
require_once(__DIR__ . '/../classes/AuthService.php');
if (empty($as))
	$as = new AuthService($config, $db);

if (isset($_page_protected) && $_page_protected === true) {
	// OAuth2 init
	require_once(__DIR__ . '/../oauth2/oauth2-init.php');
	if (!$as->loginCheck()) {
		header('Location: 403');
		exit(0);
	}
	if (!$as->loginTimeoutCheck()) {
		// if logged with OAuth2, try auto exactly one relogin
		$_location = '/';
		if (!empty($_SESSION['user_oauth2']) && empty($_SESSION['user_relogin'])) {
			if ($_SESSION['user_oauth2'] == 'SKMILE')
				$_location = $skmile_client->createAuthUrl();
			else if ($_SESSION['user_oauth2'] == 'GOOGLE')
				$_location = $google_client->createAuthUrl();
			else if ($_SESSION['user_oauth2'] == 'GITHUB')
				$_location = $github_client->createAuthUrl();
			$_SESSION['user_relogin'] = 1;
		}
		if ($_location == '/')
			$as->logout();
		header('Location: ' . $_location);
		exit(0);
	}
}
if (!empty($_SESSION['user_relogin']))
	unset($_SESSION['user_relogin']);
if (!empty($_required_acl) && !$as->aclCheck($_required_acl)) {
	header("Location: 403");
	exit(0);
}
?>