<?php

if(!empty($_POST)){
    $minPrice = $_POST['minPrice'];

    $pdo = new PDO(
        'mysql:host=localhost;dbname=cv09;charset=UTF8',
        'root',
        ''
    );
    $query = "SELECT * FROM cv09_goods WHERE good_id >= :minPrice LIMIT 10;";
    $statement = $pdo->prepare($query);
    $statement->execute([
        'minPrice'=>$minPrice
    ]);
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
    <h1>SQL injection</h1>
    <form action="./injection.php" method="POST">
        <input type="minPrice">
        <button>Submit</button>
    </form>
</body>
</html>