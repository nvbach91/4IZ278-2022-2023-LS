<?php
$dbhost = "localhost";
$dbname = "cv05";
$dbuser = "root";
$dbpass = "";

$dns = "mysql:host=$dbhost;dbname=$dbname;charset=UTF8";

try
{
    $pdo = new PDO($dns, $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `galaxies`";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $result = $staement->fetchAll();

    foreach ($results as $result)
    {
        echo "Name: " . $result["name"] . "<br>";
        echo "Size: " . $result["size"] . "<br><br>";
    }
}
catch(PDOException $exception)
{
    echo "PDO Error: " . $exception->getMessage();
}

?>