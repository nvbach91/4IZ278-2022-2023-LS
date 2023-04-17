<?php

require_once('databaseConnection.php');


$dsn = "mysql:host=$hostname;dbname=$db;charset=UTF8";



try {
    $pdo = new PDO($dsn, $user, $password);
    $query = "SELECT * FROM galaxies";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
} catch (PDOException $e) {
    echo 'unable to connect to database', $e;
}


?>