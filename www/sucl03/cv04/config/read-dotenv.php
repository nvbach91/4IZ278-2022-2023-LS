<?php
// file:cv04/config/read-dotenv.php
define('DELIMITER', ';');
define('CFG_FILE', __DIR__ . '/.env');
define('DB_FILE_USERS', __DIR__ . '/../database/users.db');

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

$config = array();
if (($config = parse_dotenv(CFG_FILE)) === false)
	exit(1);
?>