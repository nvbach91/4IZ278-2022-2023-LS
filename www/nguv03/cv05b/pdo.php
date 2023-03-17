<?php 
$hostname = 'localhost';
$db = 'startrek';
$user = 'root';
$password = '';

$dsn = "mysql:host=$hostname;dbname=$db;charset=UTF8";

try {
    $pdo = new PDO($dsn, $user, $password);
    $query = "SELECT * FROM `galaxies`";
    $statement = $pdo->prepare($query);
    $statement->execute();
    // SELECT * FROM `galaxies` WHERE id = 1;
    $results = $statement->fetchAll();
    foreach($results as $result) {
        echo $result['name'] . ' - ' . $result['size'] . '<br>';
    }
} catch (PDOException $e) {
    echo 'unable to connect to database', $e;
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
    <h2>PDO</h2>
</body>
</html>