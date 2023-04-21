<?php

var_dump($_COOKIE);
session_start();
var_dump($_SESSION);

if (!empty($_POST)) {
    $minPrice = $_POST['minPrice'];

    $pdo = new PDO(
        'mysql:host=localhost;dbname=cv09;charset=UTF8',
        'root',
        ''
    );

    $query = "SELECT * FROM cv09_goods WHERE good_id >= $minPrice LIMIT 10";
    $statement = $pdo->query($query);
    $statement->execute([
        'minPrice' => $minPrice
    ]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cv09</title>
</head>

<body>
    <form action="./index.php">
        <input type="number" name="minPrice" placeholder="minPrice">
        <button>Submit</button>
    </form>

    <a href="./buy.php?product_id=1">Buy product</a>
    <a href="./drop_cart.php">Clear cart</a>
</body>

</html>