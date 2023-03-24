<?php

const DB_HOST = 'localhost';
const DB_DATABASE = 'test';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'root';

if (!empty($_POST)) {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
        DB_USERNAME,
        DB_PASSWORD
    );
    $minPrice = $_POST['minPrice'];
    // $minPrice = "0 OR 1 = 1; --";
    // $minPrice = "0; DROP TABLE products; --";

    //$sql = "SELECT * FROM cv09_products WHERE price > $minPrice LIMIT 10;";
    //$statement = $pdo->query($sql);
    
    $sql = "SELECT * FROM cv09_products WHERE price > :minPrice LIMIT 10;";
    $statement = $pdo->prepare($sql);
    $statement->execute(['minPrice' => $minPrice]);

    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
}
?>
 
<?php if(isset($results)) : ?>

<pre>
<?php var_dump($results); ?>
</pre>

<?php else: ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <h2>Malicious form</h2>
        <input name="minPrice">
        <small>Try &quot;0; DROP TABLE products; --&quot;</small>
        <button>Submit</button>
    </form>
</body>
</html>

<?php endif; ?>
