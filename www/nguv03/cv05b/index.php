<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$databasename = 'startrek';

$connection = mysqli_connect(
    $servername,
    $username,
    $password,
    $databasename
);

// var_dump($connection);
$query = "SELECT * FROM `galaxies`";

$results = mysqli_query($connection, $query);

$records = [];
// var_dump($results);
while ($result = $results->fetch_row()) {
    array_push($records, $result);
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
    <h1>MySQL connection in PHP</h1>
    <h2>mysqli</h2>
    <?php foreach($records as $record): ?>
        <?php echo $record[0];?> <br>
        <?php echo $record[1];?> <br>
        <?php echo $record[2];?> <br>
    <?php endforeach; ?>
</body>
</html>