<?php
// crossmile @ LXSX file:www-html/index.php

// app timing
$eta = -hrtime(true);

// app init
require_once(__DIR__ . '/libs/init.php');

// SEO pages to real names
$pages_arr = [
	'index' => 'index',
	'home' => 'index',
	'login' => 'login',
	'prihlaseni' => 'login',
	'signup' => 'signup',
	'vytvoreni-uctu' => 'signup',
	'ucet' => 'profile',
	'profil' => 'profile',
	'profile' => 'profile',
	'potvrzeni' => 'confirmation',
	'confirmation' => 'confirmation',
	'races' => 'races',
	'zavody' => 'races',
	'race-details' => 'race-details',
	'detaily-zavodu' => 'race-details',
	'users' => 'users',
	'uzivatele' => 'users',
	'403' => '403_404',
	'404' => '403_404',
];

// find requested page
if (empty($_GET['page']))
	$page = 'index';
else if (array_key_exists($_GET['page'], $pages_arr))
	$page = $pages_arr[$_GET['page']];
else
	$page = '403_404';

// add header
require_once(__DIR__ . '/libs/html-header.php');
require_once(__DIR__ . '/libs/menu.php');

// include requested page
if (file_exists(__DIR__ . '/pages/' . $page . '.php'))
	require_once(__DIR__ . '/pages/' . $page . '.php');
else
	require_once(__DIR__ . '/pages/index.php');

// add header & clean-up
require(__DIR__ . '/libs/clean.php');
require(__DIR__ . '/libs/html-footer.php');
?>