<?php 
require './db/db.php';

$goodId = $_GET['good_id'];

$query = "DELETE FROM `cv09_goods` WHERE `good_id` = :goodId";
$statement = $pdo->prepare($query);
$statement->execute(['goodId' => $goodId]);

header('Location: index.php');
exit();
?>