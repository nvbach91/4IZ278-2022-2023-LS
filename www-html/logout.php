<?php
// crossmile @ LXSX file:www-html/logout.php

// app init
require_once(__DIR__ . '/libs/init.php');

// auth
require_once(__DIR__ . '/libs/login-check.php');
$as->logout();

// redirect
header('Location: /');

// clean-up
require(__DIR__ . '/libs/clean.php');
?>