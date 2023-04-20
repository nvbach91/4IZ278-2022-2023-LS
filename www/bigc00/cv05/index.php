<?php
require('./database/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database OOP</title>
</head>
<body>
    <pre>
        <?php
        $users = new UsersDB();
        $users->create(['name' => 'John', 'age' => 25]);
        $users->create(['name' => 'Jade', 'age' => 60]);
        $users->fetch();
        $users->save();
        $users->delete();
        echo PHP_EOL;

        $products = new ProductsDB();
        $products->create(['name' => 'Iron Branch', 'price' => 2500]);
        $products->create(['name' => 'Veil of Discord', 'price' => 1225]);
        echo PHP_EOL;

        $orders = new OrdersDB();
        $orders->configInfo();
        echo PHP_EOL;
        echo $orders, PHP_EOL;
        $orders->create(['number' => 12, 'date' => '2023-01-01']);
        echo $orders, PHP_EOL; 
        ?>
    </pre>
</body>
</html>