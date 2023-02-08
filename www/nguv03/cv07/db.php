<?php
// nenahravat username a password, ani dbname na git!
$db = new PDO(
    'mysql:host=localhost;dbname=test;charset=utf8mb4', 
    'root', 
    'root'
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>