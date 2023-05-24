<?php
// crossmile @ LXSX file:www-html/sitemap.php

require_once(__DIR__ . '/libs/init.php');

$lastmod['total']        = '2023-05-08';
$lastmod['index']        = '2023-05-08';
$lastmod['races']        = '2023-05-08';
$lastmod['race-details'] = '2023-05-08';
$lastmod['login']        = '2023-05-08';
$lastmod['signup']       = '2023-05-08';

$www_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['SERVER_NAME'];

if (empty($_GET['type']) || !preg_match('/^(plain|gz)$/', $_GET['type']))
	$_GET['type'] = 'gz';

// load last mod time from DB
$sql = sprintf('SELECT MAX(t1.modified) AS races_mod, MAX(t2.created) AS registrations_mod FROM races t1, registrations t2');
$stmt = $db->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = null;

// set total last mod time
$lastmod['index'] = max($lastmod['index'], date('Y-m-d', filemtime(__DIR__ . '/pages/index.php')));
$lastmod['races'] = max($lastmod['races'], $row['races_mod'], date('Y-m-d', filemtime(__DIR__ . '/pages/races.php')));
$lastmod['race-details'] = max($lastmod['race-details'], $row['registrations_mod'], date('Y-m-d', filemtime(__DIR__ . '/pages/race-details.php')));
$lastmod['login'] = max($lastmod['login'], date('Y-m-d', filemtime(__DIR__ . '/pages/login.php')));
$lastmod['signup'] = max($lastmod['signup'], date('Y-m-d', filemtime(__DIR__ . '/pages/signup.php')));
$lastmod['total'] = max($lastmod);

// prepare xml
$sitemap = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>' . $www_url . '</loc>
		<lastmod>' . date('c', strtotime($lastmod['total'])) . '</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.5</priority>
	</url>
	<url>
		<loc>' . $www_url . '/races</loc>
		<lastmod>' . date('c', strtotime($lastmod['races'])) . '</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.7</priority>
	</url>
	<url>
		<loc>' . $www_url . '/race-details</loc>
		<lastmod>' . date('c', strtotime($lastmod['race-details'])) . '</lastmod>
		<changefreq>daily</changefreq>
		<priority>0.9</priority>
	</url>
	<url>
		<loc>' . $www_url . '/login</loc>
		<lastmod>' . date('c', strtotime($lastmod['login'])) . '</lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.3</priority>
	</url>
	<url>
		<loc>' . $www_url . '/signup</loc>
		<lastmod>' . date('c', strtotime($lastmod['signup'])) . '</lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.3</priority>
	</url>
</urlset>';

// output (compressed) xml
header('Pragma: ');
header('Cache-Control: ');
if ($_GET['type'] == 'gz') {
	header('Content-Disposition: attachment; filename=sitemap.xml.gz');
	header('Content-type: application/x-gzip');
	echo gzencode('<?xml version="1.0" encoding="UTF-8"?>' . $sitemap, 9);
} else {
	header('Content-Type: application/xml');
	echo '<?xml version="1.0" encoding="UTF-8" ?>' . $sitemap;
}

// clean-up
require(__DIR__ . '/libs/clean.php');
?>