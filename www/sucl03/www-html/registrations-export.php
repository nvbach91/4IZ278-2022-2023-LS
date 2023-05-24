<?php
// crossmile @ LXSX file:www-html/registrations-export.php

$_delimiter = ';';
$_eol = "\r\n";
$_delimiter_ak = ';';
$_eol_ak = "\r\n";

$_status_arr = [
	0 => 'inactive',
	1 => 'ready',
	2 => 'paid',
	3 => 'suspended'
];

require_once(__DIR__ . '/libs/init.php');

// auth
$_page_protected = true;
$_required_acl = $app_acl['races_r'];
require_once(__DIR__ . '/libs/login-check.php');

require_once(__DIR__ . '/../libs/clubs-cas.php');
$clubs_cas_arr = getClubsCAS();

if (!empty($_GET['race']))
	$race = filter_input(INPUT_GET, 'race', FILTER_VALIDATE_REGEXP, ['options' => ['default' => '', 'regexp' => '/^([a-zA-Z0-9]{1,80})$/']]);
if (!empty($_GET['type']) && $_GET['type'] == 'ak')
	$type = 'ak';
else
	$type = 'classic';

if (!empty($race)) {
	$header = '';
	$csv = '';
	$file_name = '';
	$i = 1;
	$sql = sprintf('SELECT ' .
		't1.name AS race_name, t1.race_date, ' .
		't2.name AS discipline_name, t2.description AS discipline_description, ' .
		't2.fee, t2.gender AS discipline_gender, t2.start, ' .
		'COALESCE(t25.name, "Vše/A") AS discipline_gender_name, ' .
		't3.status AS registration_status, t3.note AS registration_note, ' .
		't3.created AS registered, ' .
		't4.last_name, t4.first_name, t4.birthday, t4.year, t4.gender, t4.club, ' .
		't4.status, t4.email ' .
		'FROM races t1 ' .
		'JOIN disciplines t2 ON t2.race = t1.id ' .
		'LEFT JOIN genders t25 ON t25.id = t2.gender ' .
		'JOIN registrations t3 ON t3.discipline = t2.id ' .
		'JOIN users t4 ON t4.id = t3.user ' .
		'WHERE t1.id = ? ' .
		'ORDER BY t2.start ASC, t4.gender DESC, t4.last_name ASC, t4.first_name ASC');
	$stmt = $db->prepare($sql);
	$stmt->bindParam(1, $race);
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		if ($i == 1) {
			$file_name = ($type == 'ak' ? 'AK-' : '') . str_replace(' ', '_', iconv("UTF-8", "ASCII//IGNORE", $row['race_name'])) . '_' . date('Y-m-d', strtotime($row['race_date'])) . '.csv';
			$race_name = $row['race_name'];
			$race_date = $row['race_date'];
		}
		if ($type == 'ak') {
			if (!in_array($row['club'], $clubs_cas_arr)) {
				if (array_key_exists($row['club'], $clubs_cas_arr))
					$row['club'] = $clubs_cas_arr[$row['club']];
				else
					$row['club'] = 'Neregistrovaný';
			}
			$csv .= $_delimiter_ak;
			$csv .= $i . $_delimiter_ak;
			$csv .= iconv("UTF8", "CP1250//TRANSLIT//IGNORE", (mb_substr($row['last_name'], 0, 20))) . $_delimiter_ak;
			$csv .= iconv("UTF8", "CP1250//TRANSLIT//IGNORE", (mb_substr($row['first_name'], 0, 15))) . $_delimiter_ak;
			$csv .= date('Y-m-d', strtotime($row['birthday'])) . $_delimiter_ak;
			$csv .= ($row['gender'] == 1 ? 1 : 2) . $_delimiter_ak;
			$csv .= iconv("UTF8", "CP1250//TRANSLIT//IGNORE", (mb_substr($row['club'], 0, 40))) . $_delimiter_ak;
			$csv .= $_delimiter_ak;
			$csv .= "CZE";
			$csv .= $_eol_ak;
		} else {
			$csv .= '"' . $row['last_name'] . '"' . $_delimiter;
			$csv .= '"' . $row['first_name'] . '"' . $_delimiter;
			$csv .= '"' . $row['year'] . '"' . $_delimiter;
			$csv .= '"' . date('Y-m-d', strtotime($row['birthday'])) . '"' . $_delimiter;
			$csv .= '"' . $row['gender'] . '"' . $_delimiter;
			$csv .= '"' . $row['club'] . '"' . $_delimiter;
			$csv .= '"' . $row['email'] . '"' . $_delimiter;
			$csv .= '"' . $row['start'] . '"' . $_delimiter;
			$csv .= '"' . $row['discipline_name'] . '"' . $_delimiter;
			$csv .= '"' . $row['discipline_description'] . '"' . $_delimiter;
			$csv .= '"' . $row['discipline_gender_name'] . '"' . $_delimiter;
			$csv .= '"' . $row['fee'] . '"' . $_delimiter;
			$csv .= '"' . date('Y-m-d H:i', strtotime($row['registered'])) . '"' . $_delimiter;
			$csv .= '"' . $_status_arr[$row['registration_status']] . '"' . $_delimiter;
			$csv .= '"' . $row['registration_note'] . '"';
			$csv .= $_eol;
		}
		$i++;
	}
	$stmt = null;

	if (!empty($csv)) {
		if ($type == 'ak') {
			$header = 'Track' . $_delimiter_ak;
			$header .= 'Bib' . $_delimiter_ak;
			$header .= 'LastName' . $_delimiter_ak;
			$header .= 'FirstName' . $_delimiter_ak;
			$header .= 'BirthDate' . $_delimiter_ak;
			$header .= 'Sex' . $_delimiter_ak;
			$header .= 'Club' . $_delimiter_ak;
			$header .= 'SeasonBest' . $_delimiter_ak;
			$header .= 'Country';
			$header .= $_eol_ak;
		} else {
			$header = '"Event:"' . $_delimiter;
			$header .= '"'. $race_name . '"' . $_delimiter;
			$header .= '"Date time:"' . $_delimiter;
			$header .= '"' . date('Y-m-d', strtotime($race_date)) . '"' . $_delimiter;
			$header .= $_eol;
			$header .= $_eol;

			$header .= '"last name"' . $_delimiter;
			$header .= '"first name"' . $_delimiter;
			$header .= '"year"' . $_delimiter;
			$header .= '"birthday"' . $_delimiter;
			$header .= '"gender"' . $_delimiter;
			$header .= '"club"' . $_delimiter;
			$header .= '"email"' . $_delimiter;
			$header .= '"start"' . $_delimiter;
			$header .= '"discipline name"' . $_delimiter;
			$header .= '"discipline descritpion"' . $_delimiter;
			$header .= '"discipline gender name"' . $_delimiter;
			$header .= '"fee"' . $_delimiter;
			$header .= '"registered"' . $_delimiter;
			$header .= '"status name"' . $_delimiter;
			$header .= '"registration note"';
			$header .= $_eol;
		}
	}
	header('Cache-Control: no-cache, must-revalidate');
	header('Content-Type: application/csv;');
	header('Content-Disposition: attachment; filename="' . $file_name . '";');
	print $header . $csv;
} else
	echo 'error';

// clean-up
require(__DIR__ . '/libs/clean.php');
?>