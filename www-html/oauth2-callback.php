<?php
// crossmile @ LXSX file:www-html/oauth2callback.php

// app init
require_once(__DIR__ . '/libs/init.php');

// users
require_once(__DIR__ . '/classes/Users.php');
$usr = new Users($config, $db, $app_acl);

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
	if (empty($_SESSION['oauth2_state']) || empty($_GET['state']) || $_SESSION['oauth2_state'] != $_GET['state'])
		header('Location: /403');
	if (empty($_GET['type']) || !preg_match('/(google|github|skmile)/', $_GET['type']))
		$_GET['type'] = 'google';
	$pair_oauth2 = (empty($_SESSION['user_relogin']) && substr($_SESSION['oauth2_state'], 0, 8) == 'profile-');
	if ($_GET['type'] == 'skmile') {
		// SK Míle OAuth2 init
		require_once(__DIR__ . '/oauth2/oauth2-init-skmile.php');
		// token
		$token_arr = $skmile_client->fetchToken($_GET['code']);
		if (!empty($token_arr['access_token'])) {
			$skmile_client->setAccessToken($token_arr['access_token']);
			// get profile info
			$account = $skmile_client->getUser();
		}
	} else if ($_GET['type'] == 'google') {
		// Google OAuth2 init
		require_once(__DIR__ . '/oauth2/oauth2-init-google.php');
		// token
		$token_arr = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
		$google_client->setAccessToken($token_arr['access_token']);
		// get profile info
		$google_oauth = new Google_Service_Oauth2($google_client);
		$account_obj = $google_oauth->userinfo->get();
		$account['id']  = $account_obj->id;
		$account['email'] = $account_obj->email;
		$account['last_name'] = $account_obj->familyName;
		$account['first_name'] = $account_obj->givenName;
	} else if ($_GET['type'] == 'github') {
		// Github OAuth2 init
		require_once(__DIR__ . '/oauth2/oauth2-init-github.php');
		// token
		$token_arr = $github_client->fetchToken($_GET['code']);
		if (!empty($token_arr['access_token'])) {
			$github_client->setAccessToken($token_arr['access_token']);
			// get profile info
			$account = $github_client->getUser();
		}
	}
	if (empty($account['id'])) {
		header('Location: /login');
		die();
	}
	$as->loginType = strtoupper($_GET['type']);
	$as->serial = $account['id'];
	$as->email = $account['email'];
	if ($pair_oauth2) {
		if ($as->email == $_SESSION['user_email']) {
			$usr->loggedUserId = $_SESSION['user_id'];
			$usr->userId = $_SESSION['user_id'];
			$usr->userOAuth2 = $as->loginType;
			$usr->userSerial = $as->serial;
			if (!$usr->userPairOAuth2())
				$_SESSION['errors_arr'] = ['user' => $usr->getLastError()];
			header('Location: /profile');
		} else {
			$_SESSION['errors_arr'] = ['user' => 'E-maily se neshodují'];
			header('Location: /profile');
		}
	} else if (!$as->login()) {
		$last_error = $as->getLastError();
		$_SESSION['errors_arr'] = ['authentication' => $last_error];
		if ($last_error == 'Neplatný uživatel') {
			$usr->userSanitized_arr['email'] = $as->email;
			if ($usr->isEmailFree()) {
				$_SESSION['oauth2_type'] = $as->loginType;
				$_SESSION['oauth2_serial'] = $as->serial;
				$_SESSION['oauth2_email'] = $as->email;
				$_SESSION['oauth2_last_name'] = $account['last_name'];
				$_SESSION['oauth2_first_name'] = $account['first_name'];
				if ($account['gender'])
					$_SESSION['oauth2_gender'] = $account['gender'];
				if ($account['birthday'])
					$_SESSION['oauth2_birthday'] = $account['birthday'];
				if ($account['club'])
					$_SESSION['oauth2_club'] = $account['club'];
				header('Location: /signup');
			} else {
				$_SESSION['errors_arr'] = [
					'authentication' => 'E-mail existuje, ale nemá povolené přihlašování pomocí ' . $as->loginType . '. ' .
										'Zvolte jiný e-mail, nebo se přihlaste jiným způsobem a ' . $as->loginType . ' spárujte.'
				];
				header('Location: /login');
			}
		} else
			header('Location: /login');
	} else {
		$_SESSION['oauth2_access_token'] = (!empty($token_arr['access_token']) ? $token_arr['access_token'] : '');
		header('Location: /profile');
	}
} else
	header('Location: /login');

// clean-up
require(__DIR__ . '/libs/clean.php');
?>