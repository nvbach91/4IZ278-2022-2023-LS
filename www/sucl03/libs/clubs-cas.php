<?php
// crossmile @ LXSX file:/libs/clubs-cas.php

function getClubsCAS()
{
	try {
		global $db;
		$sql = sprintf('SELECT short, name FROM clubs_cas ORDER BY name');
		$stmt = $db->prepare($sql);
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			$clubs_cas_arr[$row['short']] = $row['name'];
		$stmt = null;
		return (!empty($clubs_cas_arr) ? $clubs_cas_arr : false);
	} catch (PDOException $e) {
		print 'DB connection error: ' . $e->getMessage() . "<br>\n";
		die();
	}
}
?>