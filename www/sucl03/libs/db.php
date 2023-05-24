<?php
// crossmile @ LXSX file:/libs/db.php

try {
	$db = new PDO(
		'mysql:host=' . $config['DB_HOST'] . ';dbname=' . $config['DB_DEFAULT_DB'] . ';charset=utf8mb4', 
		$config['DB_USER'], 
		$config['DB_PASSWORD']
	);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	print 'DB connection error: ' . $e->getMessage() . "<br>\n";
	die();
}
?>