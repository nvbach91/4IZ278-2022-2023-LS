<?php
// crossmile @ LXSX file:www-html/libs/init.php

// show all runtime errors for developement
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// fallback exception handler to aviod Stack backtrace in case of error
function exception_handler(Throwable $e)
{
	print 'Uncaught exception: ' . $e->getMessage() . "<br>\n";
}
//set_exception_handler('exception_handler');

// all uviversal classes include 
require_once(__DIR__ . '/../../read-dotenv.php');
require_once(__DIR__ . '/../../acl.php');
require_once(__DIR__ . '/../../libs/db.php');
require_once(__DIR__ . '/utils.php');
require_once(__DIR__ . '/../classes/AuthService.php');
// init secure PHP session
$as = new AuthService($config, $db);
?>