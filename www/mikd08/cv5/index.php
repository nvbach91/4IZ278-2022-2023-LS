<?php require "db.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
    <?php
        $users = new UsersDB();
        echo $users;
        $users->create(['name' => 'Dave', 'age' => 42]);
        $users->fetch();
        $users->save();
        $users->delete();

        $products = new ProductsDB();
        echo $products;
        $products->create(['name' => 'Broom of Harry', 'price' => 4500]);
        $products->fetch();
        $products->save();
        $products->delete();

        $orders = new OrdersDB();
        echo $orders;
        $orders->create(['number' => 42, 'date' => '2019-03-08']);
        $orders->fetch();
        $orders->save();
        $orders->delete();
    ?>
    </pre>

</body>
</html>