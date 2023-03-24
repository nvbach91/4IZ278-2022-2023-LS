<?php
const DB_HOST = 'localhost';
const DB_DATABASE = 'nguv03';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

// nenahravat username a password, ani dbname na git!
$db = new PDO(
    'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4', 
    DB_USERNAME, 
    DB_PASSWORD
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>