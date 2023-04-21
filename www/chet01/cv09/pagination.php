<?php

$pdo = new PDO(
    'mysql:host=localhost;dbname=cv09;charset=UTF8',
    'root',
    ''
);

$limit = $_GET['limit'];
$limit = (int)$limit;
$offset = $_GET['offset'];
$offset = (int)$offset;

$query = "SELECT COUNT(*) FROM cv09_goods";
$statement = $pdo->prepare($query);
$statement->execute();
$total = $statement->fetchAll()[0]['COUNT(*)'];

$pageCount = ceil($total / $limit);

$query2 = "SELECT * FROM cv09_goods LIMIT :limit OFFSET :offset;";
$statement2 = $pdo->prepare($query2);
$statement2->bindParam('limit', $limit, PDO::PARAM_INT);
$statement2->bindParam('offset', $offset, PDO::PARAM_INT);
$statement2->execute();
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
    <?php for ($i = 0; $i < $pageCount; $i++) { ?>
        <a href='<?php echo "./pagination.php?limit=" . $limit . "&offset=" . $i * 3; ?>'>
            <?php echo $i + 1; ?>
        </a>
    <?php } ?>
</body>

</html>