#!/usr/bin/php -q
<?php
// crossmile @ LXSX file:logins_update.php

require_once(__DIR__ . '/read-dotenv.php');
require_once(__DIR__ . '/libs/db.php');

$debug = false;

// logger
openlog('logins-update', LOG_PID, LOG_LOCAL2);

// readGeoLocation
function readGeoLocation($api_key, $ip_addr)
{
	global $config, $redis;

	if (!$config['CACHE_ENABLED'] || ($location = $redis->get('geoip' . $ip_addr)) === false) {
		$url = 'https://api.ipgeolocation.io/ipgeo';
		$full_request = $url . '?apiKey=' . $api_key . '&ip=' . $ip_addr;
		$json = file_get_contents($full_request);
		if (!empty($json))
			$location = json_decode($json, true);
		if (empty($location['country_name']))
			$location = null;
		if ($config['CACHE_ENABLED'] && !empty($location))
			$redis->set('geoip' . $ip_addr, json_encode($location), 30 * 24 * 60 * 60);
	} else
		$location = json_decode($location, true);
	return (!empty($location['country_name']) ? $location : false);
}

// main code start
if ($debug)
	print "start...\n";

// cache
$redis = new Redis();
$redis->connect($config['REDIS_HOST'], $config['REDIS_PORT']);

// traverse logins
if ($debug)
	print "logins...\n";

$sql = sprintf("SELECT id, ip_addr FROM users_logins WHERE hostname IS NULL LIMIT 100");
$stmt = $db->prepare($sql);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$hostname = gethostbyaddr($row['ip_addr']);
	$location = [];
	if (($location = readGeoLocation($config['IPGEO_API_KEY'], $row['ip_addr'])) === false) {
		$location['country_name'] = null;
		$location['city'] = null;
	}
	$sql = sprintf("UPDATE users_logins SET hostname = ?, country_name = ?, city_name = ? WHERE id = ?");
	$stmt2 = $db->prepare($sql);
	$stmt2->bindParam(1, $hostname);
	$stmt2->bindParam(2, $location['country_name']);
	$stmt2->bindParam(3, $location['city']);
	$stmt2->bindParam(4, $row['id']);
	$stmt2->execute();
}
$stmt = null;
$stmt2 = null;

// traverse logins failed
if ($debug)
	print "failed logins...\n";

$sql = sprintf("SELECT id, ip_addr FROM users_logins_failed WHERE hostname IS NULL LIMIT 100");
$stmt = $db->prepare($sql);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$hostname = gethostbyaddr($row['ip_addr']);
	$location = [];
	if (($location = readGeoLocation($config['IPGEO_API_KEY'], $row['ip_addr'])) === false) {
		$location['country_name'] = null;
		$location['city'] = null;
	}
	$sql = sprintf("UPDATE users_logins_failed SET hostname = ?, country_name = ?, city_name = ? WHERE id = ?");
	$stmt2 = $db->prepare($sql);
	$stmt2->bindParam(1, $hostname);
	$stmt2->bindParam(2, $location['country_name']);
	$stmt2->bindParam(3, $location['city']);
	$stmt2->bindParam(4, $row['id']);
	$stmt2->execute();
}
$stmt = null;
$stmt2 = null;

if ($debug)
	print "... all done\n";

// clean-up
@$db = null;
@$redis->close();

if ($debug)
	print "exit\n";

closelog();
?>