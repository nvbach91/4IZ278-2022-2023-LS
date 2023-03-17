<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$databasename = 'nasa';

// mysqli interface
$connection = mysqli_connect(
    $servername,
    $username,
    $password,
    $databasename
);

$results = mysqli_query(
    $connection,
    "SELECT * FROM `galaxies`"
);

while ($row = mysqli_fetch_row($results)) {
    echo 'ID: ' . $row[0] . '<br>';
    echo 'Name: ' . $row[1] . '<br>';
    echo 'Size: ' . $row[2] . '<br>';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>MySQL Database connection in PHP</h1>
    <h2>mysqli</h2>
</body>
</html>