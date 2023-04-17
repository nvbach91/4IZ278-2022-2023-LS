<?php

$pdo = new PDO(
    "mysql:host=localhost;dbname=cv09;charset=UTF8",
    "root",
    ""
);

// URL parameters
// /pagination.php?limit=3&offset=0
// /pagination.php?limit=3&offset=3
// /pagination.php?limit=3&offset=6
// /pagination.php?limit=3&offset=9
$limit = $_GET['limit'];
$offset = $_GET['offset'];


$query = "SELECT COUNT(*) AS count FROM cv09_goods";
$statement = $pdo->prepare($query);
$statement->execute();
$recordCount = $statement->fetchAll()[0]['count'];
// pocet strankovani = 
//      zaokrouhlit nahoru (
//            celkovy pocet zaznamu v tabulce / pocet zaznamu na jedne strance
//      )
$paginationCount = ceil($recordCount/$limit);


$query2 = "SELECT * FROM cv09_goods ORDER BY good_id DESC LIMIT 3 OFFSET ? ;";
$statement2 = $pdo->prepare($query2);
$statement2->bindParam(1, $offset, PDO::PARAM_INT);
$statement2->execute();

$results = $statement2->fetchAll();
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
    <?php for($i = 0; $i < $paginationCount; $i++) { ?>
        <a href="<?php echo './pagination.php?limit=3&offset=' . $i * 3; ?>">
            <?php echo $i + 1; ?>
        </a>
    <?php } ?>
    <?php foreach($results as $result): ?>
        <div><?php echo $result['name']; ?> </div>
    <?php endforeach; ?>
</body>
</html>