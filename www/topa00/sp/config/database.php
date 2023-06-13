<?php
require 'constants.php';

//connecting to db via pdo
$db = new PDO("mysql:host=". DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);