<?php
$pdo = new PDO(
  'mysql:host=localhost;dbname=cv09;charset=UTF8',
  'root',
  ''
);
function getTotalRecords($pdo) {
  $statement = $pdo->prepare("SELECT COUNT(*) AS count FROM cv09_goods");
  $statement->execute();
  $result = $statement->fetchAll()[0]['count'];
  return $result;
};
$itemsCountPerPage = 11;
$totalRecords = getTotalRecords($pdo);
$paginationCount = ceil($totalRecords / $itemsCountPerPage);
function fetchRecords ($pdo, $itemsCountPerPage, $offset) {
  $query = "SELECT * FROM cv09_goods 
              ORDER BY good_id ASC
              LIMIT $itemsCountPerPage 
              OFFSET ?;";
  $statement = $pdo->prepare($query);
  $statement->bindParam(1, $offset, PDO::PARAM_INT);
  $statement->execute();
  return $statement->fetchAll();
}
if (!empty($_GET)) {
  $offset = $_GET['offset'];
} else {
  $offset = 0;
}
$records = fetchRecords($pdo, $itemsCountPerPage, $offset);

  // var_dump($records);
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
<h1>Strankovani</h1>
<ul>
  <?php for ($i = 0; $i < $paginationCount; $i++) { ?>
  <li>
    <a href="<?php echo './pagination.php?offset=' . $i * $itemsCountPerPage; ?>">
      <?php echo $i + 1 . ': offset=' . $i * $itemsCountPerPage; ?>
    </a>
  </li>
  <?php } ?>
</ul>
<div>
  <?php foreach($records as $record): ?>
    <div><?php echo $record['good_id'] . ': ' . $record['name'];?></div>
  <?php endforeach; ?>
</div>
</body>

</html>