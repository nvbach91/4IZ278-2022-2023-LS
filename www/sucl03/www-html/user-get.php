<?php
// crossmile @ LXSX file:www-html/user-get.php

require_once(__DIR__ . '/libs/init.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || empty($_POST['id']) || !isInteger($_POST['id'])) {
	print 'no POST';
	exit();
}

// auth
$_page_protected = true;
$_required_acl = $app_acl['users_r'];
require_once(__DIR__ . '/libs/login-check.php');
$logged_user_arr = $as->getUser();

require_once(__DIR__ . '/../libs/clubs-cas.php');
$clubs_cas_arr = getClubsCAS();

require_once(__DIR__ . '/classes/Users.php');
$usr = new Users($config, $db, $app_acl);
$usr->loggedUserId = $logged_user_arr['user_id'];
$usr->userId = $_POST['id'];
$user_arr = $usr->getUser();

echo json_encode(!empty($user_arr) ? $user_arr : '');

// clean-up
require(__DIR__ . '/libs/clean.php');
?>