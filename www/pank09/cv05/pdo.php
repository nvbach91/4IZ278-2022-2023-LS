<?php
$dbhost = "localhost";
$dbname = "cv05";
$dbuser = "root";
$dbpass = "";

$dsn = "mysql:host=$dbhost;dbname=$dbname;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbuser, $dbpass);

    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `galaxies`";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();

    foreach ($results as $result) {
        echo "Name: " . $result["name"] . "<br>";
        echo "Size: " . $result["size"] . "<br><br>";
    }

} catch(PDOException $e) {
    echo "PDO Error: " . $e->getMessage();
}
?>