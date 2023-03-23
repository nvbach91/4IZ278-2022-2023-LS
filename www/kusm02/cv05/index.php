<?php include 'db.php'; ?>
<?php include 'userdb.php'; ?>
<?php include 'productsdb.php'; ?>
<?php include 'ordersdb.php'; ?>
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
    echo "";
}

interface DatabaseOperations {
    public function fetch();
    public function create($args);
    public function save();
    public function delete();
}

$users = new UsersDB();
$users->create(['name' => 'Dave', 'age' => 42]);
$users->create(['name' => 'Dave', 'age' => 42]);
$users->fetch();
$users->save();
$users->delete();
echo PHP_EOL . '<br>';

$products = new ProductsDB();
$products->create(['name' => 'Broom of Harry', 'price' => 4500]);
$products->create(['name' => 'Wand of Albuss', 'price' => 7690]);
echo PHP_EOL . '<br>';

$orders = new OrdersDB();
$orders->configInfo();
echo PHP_EOL . '<br>';
echo $orders, PHP_EOL . '<br>';
$orders->create(['number' => 42, 'date' => '2019-03-08']);
echo $orders, PHP_EOL . '<br>';

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
</body>
</html>
