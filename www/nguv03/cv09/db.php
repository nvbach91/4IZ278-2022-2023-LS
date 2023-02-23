<?php
const DB_HOST = 'localhost';
const DB_DATABASE = 'test';
const DB_USERNAME = 'test';
const DB_PASSWORD = 'test';

// nenahravat username a password, ani dbname na git!
$db = new PDO(
    'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4', 
    DB_USERNAME, 
    DB_PASSWORD
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>