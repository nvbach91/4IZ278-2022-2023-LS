<?php

$host = 'localhost';
$db = 'nasa';
$user = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    $query = "SELECT * FROM `galaxies` WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->execute([
        'id' => 1
    ]);
    $results = $statement->fetchAll();
    foreach($results as $result) {
        echo $result['name'] . '<br>';
    }
} catch (PDOException $e) {
    echo "unable to connect to db";
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
    <h2>PDO</h2>
</body>
</html>