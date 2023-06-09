<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$databaseName = 'bookstore';

$connection = mysqli_connect(
    $servername,
    $username,
    $password,
    $databaseName
) or die('Connection failed');
