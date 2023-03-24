<?php
$servername = "localhost";
$database = "nguv03";
$username = "root";
$password = "";
?>

<?php
// Create connection object oriented style
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    exit("Connection failed: " . $connection->connect_error);
} 
echo "Connected successfully OOP STYLE" . '<br>';
// you can close manually, 
// otherwise the connection will close automatically when the script ends
$connection->close();
echo "Connection closed" . '<br>';
?>


<?php
// Create connection in procedural style
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    exit("Connection failed: " . mysqli_connect_error());
} 
echo "Connected successfully PROCEDURAL STYLE" . '<br>';
// you can close manually, 
// otherwise the connection will close automatically when the script ends
mysqli_close($connection);
echo "Connection closed" . '<br>';
?>


<?php
try {
    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully PDO STYLE" . '<br>'; 
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$connection = null;
echo "Connection closed" . '<br>';
?>