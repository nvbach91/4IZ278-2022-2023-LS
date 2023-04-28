<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cv05";

    // MySQLi 
    $connection = mysqli_connect(
        $servername,
        $username,
        $password,
        $dbname
    );

    if (!$connection)
        die("Connection failed: " . mysqli_connect_error());

    $results = mysqli_query($connection, "SELECT * FROM `galaxies`");

    while ($row = mysqli_fetch_row($results)) {
        echo "ID:   " . $row[0] . "<br>";
        echo "Name: " . $row[1] . "<br>";
        echo "Size: " . $row[2] . "<br><br>";
    }

?>