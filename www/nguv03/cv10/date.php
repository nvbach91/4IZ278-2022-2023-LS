<?php

require __DIR__ . '/db.php';

$date = time();
$tosave = date("Y-m-d H:i:s", $date);


$sql = "INSERT INTO cv10_orders(date) VALUES (:date)";
$statement = $db->prepare($sql);
$statement->execute(['date' => $tosave]);


?>