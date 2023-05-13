<?php
// crossmile @ LXSX file:read-dotenv.php

define('CFG_FILE', __DIR__ . '/.env');

function parse_dotenv($file = '')
{
	$cfg = [];
	if (empty($file))
		$file = './.env';
	if (!file_exists($file))
		return (false);
	if (($lines_arr = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)) === false)
		return (false);
	foreach ($lines_arr as $line) {
		if (!empty($line) && substr($line, 0, 1) != '#') {
			//$line = str_replace(' ', '', $line);
			if (!empty($line) && strpos($line, '=') !== false) {
				$fields_arr = explode('=', $line);
				if (!empty($fields_arr[0]) && !empty($fields_arr[1]))
					$cfg += array(trim($fields_arr[0]) => trim(trim($fields_arr[1]), '"\''));
			}
		}
	}
	return (!empty($cfg) ? $cfg : false);
}

$config = [];
if (($config = parse_dotenv(CFG_FILE)) === false)
	die();
?>