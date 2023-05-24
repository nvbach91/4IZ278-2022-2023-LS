<?php
// crossmile @ LXSX file:www-html/libs/utils.php

function genRandomString($len = 32)
{
	$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$string = '';
	for ($i = 0; $i < $len; $i++)
		$string .= $chars[mt_rand(0, strlen($chars) - 1)];
	return ($string);
}

function isInvalid($errors_arr, $name)
{
	return (array_key_exists($name, $errors_arr) ? ' is-invalid' : '');
}

function validateDateTime($date, $format = 'Y-m-d')
{
	$d = DateTime::createFromFormat($format, $date);
	return ($d && $d->format($format) == $date);
}

function isInteger($input)
{
	return (ctype_digit(strval($input)));
}

?>