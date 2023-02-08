<?php require './config.php'; ?>
<?php 



$connection = new mysqli(
    $databaseUrl, 
    $databaseUsername, 
    $databasePassword,
    $databaseName
);

// var_dump($connection);

$connection = mysqli_connect(
    $databaseUrl, 
    $databaseUsername, 
    $databasePassword,
    $databaseName
);

// var_dump($connection);
$connectionString = "mysql:host=$databaseUrl;dbname=$databaseName";
try {
    $connection = new PDO(
        $connectionString,
        $databaseUsername,
        $databasePassword
    );
} catch(PDOException $e) {

}


// var_dump($connection);

$statement = $connection->prepare("SELECT * FROM books;");
$statement->execute();
$result = $statement->fetchAll();

// var_dump($result);

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
    <?php foreach($result as $r): ?>
        <div class="book">
            <div><?php echo $r['book_id']; ?></div>
            <div><?php echo $r['title']; ?></div>
            <div><?php echo $r['price']; ?></div>
            <div><?php echo $r['publish_year']; ?></div>
        </div>
    <?php endforeach;?>
</body>
</html>
