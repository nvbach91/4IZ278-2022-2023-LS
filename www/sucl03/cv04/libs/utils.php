<?php
// file:cv04/libs/utils.php
function is_invalid($errors_arr, $name)
{
	return (array_key_exists($name, $errors_arr) ? ' is-invalid' : '');
}

function hide_password($password)
{
	return (preg_replace('/./', '*', $password));
}

function read_parse_csv($file, $delimiter)
{
	$csv_arr = array_map(fn($el) => str_getcsv($el, $delimiter, '"'), file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
	array_walk($csv_arr, function(&$tmp_arr) use ($csv_arr) {
		$tmp_arr = array_combine($csv_arr[0], $tmp_arr);
	});
	array_shift($csv_arr);
	return ($csv_arr);
}

function create_append_csv($csv_arr, $file, $delimiter)
{
	$fp = fopen($file, 'a');
	if (fputcsv($fp, $csv_arr, $delimiter) === false) {
		fclose($fp);
		return (false);
	}
	fclose($fp);
	return (true);
}
?>