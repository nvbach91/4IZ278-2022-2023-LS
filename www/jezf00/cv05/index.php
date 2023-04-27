<?php
      require './database/OrdersDB';
      require './database/ProductsDB.php';
      require './database/UsersDB.php';
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Database cv05</title>
</head>
<body>
<header></header>
<main>
  <h1>Database Operations</h1>
  <pre>
<?php  $users = new UsersDB();
echo $users, PHP_EOL;
$users->create(['name' => 'Filip', 'age' => 21]);
$users->create(['name' => 'David', 'age' => 22]);
$users->fetch();
$users->delete();
echo PHP_EOL;

$products = new ProductsDB();
echo $products, PHP_EOL;
$products->create(['name' => 'Table', 'price' => 89]);
$products->create(['name' => 'Chair', 'price' => 64]);
$products->fetch();
echo PHP_EOL;

$orders = new OrdersDB();
echo $orders, PHP_EOL;
$orders->create(['number' => 15]);
$orders->fetch();
echo PHP_EOL;
?>
  </pre>
</main>
<footer></footer>
</body>
</html>