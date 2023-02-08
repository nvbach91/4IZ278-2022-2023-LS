<?php 

$db = new PDO(
    'mysql:host=localhost;dbname=nguv03;charset=utf8mb4',
    'nguv03',
    'ny;W7pqYwamf(@&ufA'
);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::ERRMODE_EXCEPTION);

?>