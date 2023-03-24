<?php
// file:cv05/libs/utils.php

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

function create_write_csv($csv_header, $csv_arr, $file, $delimiter)
{
	$fp = fopen($file, 'w');
	if (fputcsv($fp, $csv_header, $delimiter) === false) {
		fclose($fp);
		return (false);
	}
	foreach ($csv_arr as $fields_arr) {
		if (fputcsv($fp, $fields_arr, $delimiter) === false) {
			fclose($fp);
			return (false);
		}
	}
	fclose($fp);
	return (true);
}
?>