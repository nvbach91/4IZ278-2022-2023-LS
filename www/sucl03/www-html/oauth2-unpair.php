<?php
// crossmile @ LXSX file:www-html/unpair-oauth2.php

// app init
require_once(__DIR__ . '/libs/init.php');

// auth
$_page_protected = true;
$_required_acl = $app_acl['login'];
require_once(__DIR__ . '/libs/login-check.php');

if (!empty($_SESSION['user_id']) && !empty($_GET['type']) && preg_match('/(SKMILE|GOOGLE|GITHUB)/i', $_GET['type'])) {
	require_once(__DIR__ . '/classes/Users.php');
	$_GET['type'] = strtoupper($_GET['type']);
	$usr = new Users($config, $db, $app_acl);
	$usr->loggedUserId = $_SESSION['user_id'];
	$usr->userId = $_SESSION['user_id'];
	$usr->userOAuth2 = $_GET['type'];
	if ($usr->userUnpairOAuth2()) {
		if (!empty($_SESSION['user_oauth2']) && $_SESSION['user_oauth2'] == $_GET['type'])
			unset($_SESSION['user_oauth2']);
	} else
		$errors_arr['user'] = $usr->getLastError();
}

// redirect
header('Location: /profile');

// clean-up
require(__DIR__ . '/libs/clean.php');
?>